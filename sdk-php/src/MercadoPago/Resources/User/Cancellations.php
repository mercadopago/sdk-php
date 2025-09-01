<?php

namespace MercadoPago\Resources\User;

/** Cancellations class. */
class Cancellations
{
    /** The cancellations period (e.g., "365 days"). */
    public ?string $period;

    /** The cancellations rate (percentage). */
    public ?float $rate;

    /** The cancellations value. */
    public ?float $value;
}
