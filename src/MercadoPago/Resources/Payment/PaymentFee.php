<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents a fee or interest charge applied to a payment method in the MercadoPago API.
 *
 * Used for late-payment fines and interest charges on offline payment methods
 * (e.g. boleto). Nested within {@see PaymentMethodRules}.
 */
class PaymentFee
{
    /** Fee type (e.g. "fixed", "percentage"). */
    public ?string $type;

    /** Fee value (absolute amount or percentage depending on type). */
    public ?float $value;
}
