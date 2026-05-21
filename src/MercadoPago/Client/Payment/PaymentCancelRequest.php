<?php

namespace MercadoPago\Client\Payment;

/**
 * Internal request payload for payment cancellation.
 *
 * Used by {@see PaymentClient::cancel()} to set the payment status to "cancelled".
 */
class PaymentCancelRequest
{
    /** Target payment status. Always "cancelled" for this request type. */
    public string $status = "cancelled";
}
