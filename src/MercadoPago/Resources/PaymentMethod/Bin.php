<?php

namespace MercadoPago\Resources\PaymentMethod;

/** Bin class. */
class Bin
{
    /** Bin pattern. */
    public ?string $pattern;

    /** Bin exclusion pattern. */
    public ?string $exclusion_pattern;

    /** Bin installments pattern. */
    public ?string $installments_pattern;
}
