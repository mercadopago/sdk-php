<?php

namespace MercadoPago\Client\Payment;

/**
 * Internal request payload for partial payment refunds.
 *
 * Used by {@see PaymentRefundClient::refund()} to specify the refund amount.
 */
class PaymentRefundCreateRequest
{
    /** Amount to refund. Must be less than or equal to the remaining payment balance. */
    public float $amount;
}
