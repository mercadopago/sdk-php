<?php

namespace MercadoPago\Client\Payment;

/** PaymentCaptureRequest class. */
class PaymentCaptureRequest
{
    /** Status cancelled. */
    public $capture = true;

    /** Transaction amount. */
    public $transaction_amount;
}
