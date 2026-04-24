<?php

namespace MercadoPago\Resources\User;

/**
 * User Seller Cancellations Metric resource.
 *
 * Represents the seller's order cancellation metrics for a specific period,
 * including the cancellation rate and absolute value used in reputation scoring.
 */
class Cancellations
{
    /** The cancellations period (e.g., "365 days"). */
    public ?string $period;

    /** The cancellations rate (percentage). */
    public ?float $rate;

    /** The cancellations value. */
    public ?float $value;
}
