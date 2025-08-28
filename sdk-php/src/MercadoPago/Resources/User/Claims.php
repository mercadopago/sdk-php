<?php

namespace MercadoPago\Resources\User;

/** Claims class. */
class Claims
{
    /** The claims period (e.g., "365 days"). */
    public ?string $period;

    /** The claims rate (percentage). */
    public ?float $rate;

    /** The claims value. */
    public ?float $value;
}
