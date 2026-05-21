<?php

namespace MercadoPago\Webhook;

use InvalidArgumentException;
use MercadoPago\Exceptions\InvalidWebhookSignatureException;
use MercadoPago\Exceptions\SignatureFailureReason;

/**
 * Verifies the authenticity of an incoming MercadoPago webhook notification by
 * recomputing the HMAC-SHA256 signature locally and comparing it against the
 * value carried in the `x-signature` header.
 *
 * This is a stateless, CPU-only utility. It performs no outbound HTTP calls
 * and does not depend on {@see \MercadoPago\MercadoPagoConfig}; the integrator
 * passes the secret signature explicitly on every call. The comparison is
 * performed in constant time (via `hash_equals`) to mitigate timing attacks.
 *
 * On failure, the validator throws {@see InvalidWebhookSignatureException} with
 * a specific {@see SignatureFailureReason}. The integrator should respond with
 * HTTP 401 to MercadoPago in all failure cases, log the request id for
 * correlation, and not expose the failure reason in the HTTP response body.
 *
 * **QR Code notifications are not signed by MercadoPago** — do not call this
 * validator for those events; they will always fail signature verification.
 */
final class WebhookSignatureValidator
{
    /** @var string[] Default signature versions accepted by the validator. */
    private const DEFAULT_SUPPORTED_VERSIONS = ['v1'];

    private const VERSION_KEY_REGEX = '/^v\d+$/';

    private function __construct()
    {
        // Static-only class — prevent instantiation.
    }

    /**
     * Validates the signature of a MercadoPago webhook notification.
     *
     * @param string|null     $xSignature        Raw value of the `x-signature` request header.
     * @param string|null     $xRequestId        Value of the `x-request-id` request header. May be null/empty;
     *                                           in that case the `request-id:` pair is omitted from the manifest.
     * @param string|null     $dataId            Value of the `data.id` query parameter. May be null/empty;
     *                                           in that case the `id:` pair is omitted. Lowercased before HMAC.
     * @param string          $secret            Secret signature configured in Tus Integraciones (HMAC key).
     * @param int|null        $toleranceSeconds  Optional maximum allowed drift in seconds between the timestamp
     *                                           in the header and the current clock. Omit to skip the check.
     * @param string[]|null   $supportedVersions Optional ordered list of signature versions to accept.
     *                                           Defaults to `['v1']`. The validator iterates in order and uses
     *                                           the first version found in the header.
     * @param callable|null   $nowProvider       Optional callable returning the current time in milliseconds
     *                                           since the Unix epoch. Intended for tests.
     *
     * @throws InvalidWebhookSignatureException On any signature verification failure.
     * @throws InvalidArgumentException         When `$secret` is null or empty.
     */
    public static function validate(
        ?string $xSignature,
        ?string $xRequestId,
        ?string $dataId,
        string $secret,
        ?int $toleranceSeconds = null,
        ?array $supportedVersions = null,
        ?callable $nowProvider = null
    ): void {
        if ($secret === '') {
            throw new InvalidArgumentException('secret must not be empty');
        }

        $xSignature = self::normalize($xSignature);
        $xRequestId = self::normalize($xRequestId);
        $dataId = self::normalize($dataId);
        $versions = $supportedVersions ?: self::DEFAULT_SUPPORTED_VERSIONS;
        $now = $nowProvider ?? static fn(): int => (int) (microtime(true) * 1000);

        if ($xSignature === null) {
            throw new InvalidWebhookSignatureException(
                SignatureFailureReason::MISSING_SIGNATURE_HEADER,
                $xRequestId
            );
        }

        [$ts, $hashes] = self::parseSignatureHeader($xSignature);

        if ($ts === null && empty($hashes)) {
            throw new InvalidWebhookSignatureException(
                SignatureFailureReason::MALFORMED_SIGNATURE_HEADER,
                $xRequestId
            );
        }

        if ($ts === null) {
            throw new InvalidWebhookSignatureException(
                SignatureFailureReason::MISSING_TIMESTAMP,
                $xRequestId
            );
        }

        if (!ctype_digit($ts)) {
            throw new InvalidWebhookSignatureException(
                SignatureFailureReason::MALFORMED_SIGNATURE_HEADER,
                $xRequestId,
                $ts
            );
        }

        $receivedHash = null;
        foreach ($versions as $version) {
            if (isset($hashes[$version])) {
                $receivedHash = $hashes[$version];
                break;
            }
        }

        if ($receivedHash === null) {
            throw new InvalidWebhookSignatureException(
                SignatureFailureReason::MISSING_HASH,
                $xRequestId,
                $ts
            );
        }

        $manifest = self::buildManifest($dataId, $xRequestId, $ts);
        $computed = hash_hmac('sha256', $manifest, $secret);

        if (!hash_equals($computed, $receivedHash)) {
            throw new InvalidWebhookSignatureException(
                SignatureFailureReason::SIGNATURE_MISMATCH,
                $xRequestId,
                $ts
            );
        }

        if ($toleranceSeconds !== null) {
            $driftMs = abs($now() - (int) $ts);
            if ($driftMs > $toleranceSeconds * 1000) {
                throw new InvalidWebhookSignatureException(
                    SignatureFailureReason::TIMESTAMP_OUT_OF_TOLERANCE,
                    $xRequestId,
                    $ts
                );
            }
        }
    }

    /**
     * Coerces a value into a trimmed non-empty string, or null when missing.
     */
    private static function normalize(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $trimmed = trim($value);
        return $trimmed === '' ? null : $trimmed;
    }

    /**
     * Parses the `x-signature` header into `[ts, [vN => hash, ...]]`.
     *
     * @return array{0: string|null, 1: array<string, string>}
     */
    private static function parseSignatureHeader(string $header): array
    {
        $hashes = [];
        $ts = null;

        foreach (explode(',', $header) as $part) {
            $pieces = explode('=', $part, 2);
            if (count($pieces) !== 2) {
                continue;
            }

            $key = strtolower(trim($pieces[0]));
            $value = trim($pieces[1]);
            if ($key === '' || $value === '') {
                continue;
            }

            if ($key === 'ts') {
                $ts = $value;
            } elseif (preg_match(self::VERSION_KEY_REGEX, $key)) {
                $hashes[$key] = $value;
            }
        }

        return [$ts, $hashes];
    }

    /**
     * Builds the HMAC manifest, omitting pairs whose value is missing.
     */
    private static function buildManifest(?string $dataId, ?string $requestId, string $ts): string
    {
        $parts = [];
        if ($dataId !== null) {
            $parts[] = 'id:' . strtolower($dataId);
        }

        if ($requestId !== null) {
            $parts[] = 'request-id:' . $requestId;
        }

        $parts[] = 'ts:' . $ts;
        return implode(';', $parts) . ';';
    }
}
