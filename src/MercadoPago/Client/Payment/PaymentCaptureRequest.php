<?php

namespace MercadoPago\Client\Payment;

/** PaymentCaptureRequest class. */
class PaymentCaptureRequest
{
    /** Status cancelled. */
    public bool $capture = true;

    /** Transaction amount. */
    public float $transaction_amount;
}
