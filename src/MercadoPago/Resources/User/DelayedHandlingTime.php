<?php

namespace MercadoPago\Resources\User;

/**
 * User Seller Delayed Handling Time Metric resource.
 *
 * Represents the seller's delayed handling time metrics for a specific period,
 * measuring how often the seller takes longer than expected to ship orders.
 */
class DelayedHandlingTime
{
    /** The delayed handling time period (e.g., "365 days"). */
    public ?string $period;

    /** The delayed handling time rate (percentage). */
    public ?float $rate;

    /** The delayed handling time value. */
    public ?float $value;
}
