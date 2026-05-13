<?php

namespace MercadoPago\Tests\Webhook\Unit;

use InvalidArgumentException;
use MercadoPago\Exceptions\InvalidWebhookSignatureException;
use MercadoPago\Exceptions\SignatureFailureReason;
use MercadoPago\Webhook\WebhookSignatureValidator;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for {@see WebhookSignatureValidator}. Self-contained; no network access.
 */
final class WebhookSignatureValidatorUnitTest extends TestCase
{
    private const SECRET = 'your_secret_key_here';
    private const REQUEST_ID = '2066ca19-c6f1-498a-be75-1923005edd06';
    private const DATA_ID_RAW = 'ORD01JQ4S4KY8HWQ6NA5PXB65B3D3';
    private const DATA_ID_LOWER = 'ord01jq4s4ky8hwq6na5pxb65b3d3';
    private const TS = '1742505638683';

    private static function computeHash(?string $dataId, ?string $requestId, string $ts, string $secret): string
    {
        $parts = [];
        if ($dataId) {
            $parts[] = 'id:' . strtolower($dataId);
        }
        if ($requestId) {
            $parts[] = 'request-id:' . $requestId;
        }
        $parts[] = 'ts:' . $ts;
        $manifest = implode(';', $parts) . ';';
        return hash_hmac('sha256', $manifest, $secret);
    }

    private static function buildHeader(string $hash, string $ts = self::TS, string $version = 'v1'): string
    {
        return "ts={$ts},{$version}={$hash}";
    }

    private static function validHash(): string
    {
        return self::computeHash(self::DATA_ID_LOWER, self::REQUEST_ID, self::TS, self::SECRET);
    }

    // case 1
    public function testHappyPathLowercase(): void
    {
        $header = self::buildHeader(self::validHash());
        WebhookSignatureValidator::validate($header, self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
        $this->assertTrue(true); // no throw expected
    }

    // case 2
    public function testUppercaseDataIdIsLowercased(): void
    {
        $header = self::buildHeader(self::validHash());
        WebhookSignatureValidator::validate($header, self::REQUEST_ID, self::DATA_ID_RAW, self::SECRET);
        $this->assertTrue(true);
    }

    // case 3
    public function testMalformedHeaderThrowsMalformed(): void
    {
        try {
            WebhookSignatureValidator::validate('this-is-garbage', self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
            $this->fail('expected throw');
        } catch (InvalidWebhookSignatureException $e) {
            $this->assertSame(SignatureFailureReason::MALFORMED_SIGNATURE_HEADER, $e->getReason());
            $this->assertSame(self::REQUEST_ID, $e->getRequestId());
        }
    }

    // case 4
    public function testMissingHeaderThrowsMissingHeader(): void
    {
        try {
            WebhookSignatureValidator::validate(null, self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
            $this->fail('expected throw');
        } catch (InvalidWebhookSignatureException $e) {
            $this->assertSame(SignatureFailureReason::MISSING_SIGNATURE_HEADER, $e->getReason());
        }
    }

    // case 5
    public function testMissingTsThrowsMissingTimestamp(): void
    {
        try {
            WebhookSignatureValidator::validate('v1=' . self::validHash(), self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
            $this->fail('expected throw');
        } catch (InvalidWebhookSignatureException $e) {
            $this->assertSame(SignatureFailureReason::MISSING_TIMESTAMP, $e->getReason());
        }
    }

    // case 6
    public function testMissingV1ThrowsMissingHash(): void
    {
        try {
            WebhookSignatureValidator::validate('ts=' . self::TS, self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
            $this->fail('expected throw');
        } catch (InvalidWebhookSignatureException $e) {
            $this->assertSame(SignatureFailureReason::MISSING_HASH, $e->getReason());
            $this->assertSame(self::TS, $e->getTimestamp());
        }
    }

    // case 7
    public function testTamperedHashThrowsSignatureMismatch(): void
    {
        $h = self::validHash();
        $tampered = substr($h, 0, -2) . (str_ends_with($h, '00') ? 'ff' : '00');
        try {
            WebhookSignatureValidator::validate(self::buildHeader($tampered), self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
            $this->fail('expected throw');
        } catch (InvalidWebhookSignatureException $e) {
            $this->assertSame(SignatureFailureReason::SIGNATURE_MISMATCH, $e->getReason());
        }
    }

    // case 8
    public function testOutsideToleranceThrows(): void
    {
        $staleTs = (string) ((int) (microtime(true) * 1000) - 30 * 60 * 1000);
        $h = self::computeHash(self::DATA_ID_LOWER, self::REQUEST_ID, $staleTs, self::SECRET);
        try {
            WebhookSignatureValidator::validate(
                self::buildHeader($h, $staleTs),
                self::REQUEST_ID,
                self::DATA_ID_LOWER,
                self::SECRET,
                300
            );
            $this->fail('expected throw');
        } catch (InvalidWebhookSignatureException $e) {
            $this->assertSame(SignatureFailureReason::TIMESTAMP_OUT_OF_TOLERANCE, $e->getReason());
        }
    }

    public function testWithinTolerancePasses(): void
    {
        $current = (string) (int) (microtime(true) * 1000);
        $h = self::computeHash(self::DATA_ID_LOWER, self::REQUEST_ID, $current, self::SECRET);
        WebhookSignatureValidator::validate(
            self::buildHeader($h, $current),
            self::REQUEST_ID,
            self::DATA_ID_LOWER,
            self::SECRET,
            300
        );
        $this->assertTrue(true);
    }

    // case 9
    public function testDataIdAbsentExcludesIdPair(): void
    {
        $h = self::computeHash(null, self::REQUEST_ID, self::TS, self::SECRET);
        WebhookSignatureValidator::validate(self::buildHeader($h), self::REQUEST_ID, null, self::SECRET);
        $this->assertTrue(true);
    }

    // case 10
    public function testRequestIdAbsentExcludesRequestIdPair(): void
    {
        $h = self::computeHash(self::DATA_ID_LOWER, null, self::TS, self::SECRET);
        WebhookSignatureValidator::validate(self::buildHeader($h), null, self::DATA_ID_LOWER, self::SECRET);
        $this->assertTrue(true);
    }

    // case 11
    public function testBothAbsentYieldsTsOnly(): void
    {
        $h = self::computeHash(null, null, self::TS, self::SECRET);
        WebhookSignatureValidator::validate(self::buildHeader($h), '', '   ', self::SECRET);
        $this->assertTrue(true);
    }

    // case 12
    public function testNonPaymentTopicUsesSameAlgorithm(): void
    {
        $orderId = 'ord01abc123';
        $h = self::computeHash($orderId, self::REQUEST_ID, self::TS, self::SECRET);
        WebhookSignatureValidator::validate(self::buildHeader($h), self::REQUEST_ID, $orderId, self::SECRET);
        $this->assertTrue(true);
    }

    public function testSupportsV1WhenBothPresent(): void
    {
        $header = sprintf('ts=%s,v1=%s,v2=aaaa', self::TS, self::validHash());
        WebhookSignatureValidator::validate($header, self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
        $this->assertTrue(true);
    }

    public function testOnlyV2InHeaderOnlyV1SupportedThrowsMissingHash(): void
    {
        $header = sprintf('ts=%s,v2=somehash', self::TS);
        try {
            WebhookSignatureValidator::validate($header, self::REQUEST_ID, self::DATA_ID_LOWER, self::SECRET);
            $this->fail('expected throw');
        } catch (InvalidWebhookSignatureException $e) {
            $this->assertSame(SignatureFailureReason::MISSING_HASH, $e->getReason());
        }
    }

    public function testEmptySecretRaisesInvalidArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        WebhookSignatureValidator::validate(self::buildHeader(self::validHash()), self::REQUEST_ID, self::DATA_ID_LOWER, '');
    }
}
