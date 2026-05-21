<?php

namespace MercadoPago\Exceptions;

/**
 * Enumerates the reasons why {@see \MercadoPago\Webhook\WebhookSignatureValidator}
 * may reject a MercadoPago webhook notification.
 *
 * Integrators are encouraged to log this value alongside the `x-request-id`
 * for correlation against the MercadoPago notifications dashboard.
 */
final class SignatureFailureReason
{
    /** The `x-signature` header was missing, empty, or whitespace. */
    public const MISSING_SIGNATURE_HEADER = 'MissingSignatureHeader';

    /** The header did not match the expected `ts=...,vN=...` format. */
    public const MALFORMED_SIGNATURE_HEADER = 'MalformedSignatureHeader';

    /** The header parsed correctly but no `ts=` component was present. */
    public const MISSING_TIMESTAMP = 'MissingTimestamp';

    /** No hash was found in the header for any of the supported versions. */
    public const MISSING_HASH = 'MissingHash';

    /** The computed HMAC did not match the value in the header. */
    public const SIGNATURE_MISMATCH = 'SignatureMismatch';

    /** The header timestamp fell outside the configured tolerance window. */
    public const TIMESTAMP_OUT_OF_TOLERANCE = 'TimestampOutOfTolerance';

    private function __construct()
    {
        // Static-only class — prevent instantiation.
    }
}
