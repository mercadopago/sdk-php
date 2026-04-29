<?php

namespace MercadoPago\Resources\PaymentMethod;

/**
 * Payment Method BIN (Bank Identification Number) settings resource.
 *
 * Defines regex patterns that determine which card BINs are accepted,
 * excluded, or eligible for installments within a payment method's settings.
 */
class Bin
{
    /** Regex pattern matching accepted card BINs (first 6-8 digits of the card number). */
    public ?string $pattern;

    /** Regex pattern matching card BINs explicitly excluded from this payment method. */
    public ?string $exclusion_pattern;

    /** Regex pattern matching card BINs eligible for installment plans. */
    public ?string $installments_pattern;
}
