<?php

namespace MercadoPago\Resources\Payment;

/** Payer identification class. */
class Identification
{
    /** Type of identification. */
    public ?string $type;

    /** Unique number of that identification. */
    public ?string $number;
}
