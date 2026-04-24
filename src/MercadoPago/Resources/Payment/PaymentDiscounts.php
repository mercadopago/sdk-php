<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents a discount rule applied to a payment method in the MercadoPago API.
 *
 * Defines early-payment discounts (e.g. for boleto) that incentivize payers to
 * complete payment before a specified date. Nested within {@see PaymentMethodRules}.
 */
class PaymentDiscounts
{
    /** Discount type (e.g. "fixed", "percentage"). */
    public ?string $type;

    /** Discount value (absolute amount or percentage depending on type). */
    public ?float $value;

    /** ISO 8601 date until which the discount is valid. */
    public ?string $limit_date;
}
