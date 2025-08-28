<?php

namespace MercadoPago\Resources\User;

/** DelayedHandlingTime class. */
class DelayedHandlingTime
{
    /** The delayed handling time period (e.g., "365 days"). */
    public ?string $period;

    /** The delayed handling time rate (percentage). */
    public ?float $rate;

    /** The delayed handling time value. */
    public ?float $value;
}
