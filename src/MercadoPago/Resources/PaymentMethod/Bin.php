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
    /** Bin pattern. */
    public ?string $pattern;

    /** Bin exclusion pattern. */
    public ?string $exclusion_pattern;

    /** Bin installments pattern. */
    public ?string $installments_pattern;
}
