<?php

namespace MercadoPago\Client\Payment;

/**
 * Internal request payload for payment capture.
 *
 * Used by {@see PaymentClient::capture()} to capture an authorized payment.
 */
class PaymentCaptureRequest
{
    /** Flag indicating this is a capture operation. Always true. */
    public bool $capture = true;

    /** Amount to capture. When null, the full authorized amount is captured. */
    public float $transaction_amount;
}
