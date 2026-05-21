<?php

namespace MercadoPago\Resources\User;

/**
 * User Seller Claims Metric resource.
 *
 * Represents the seller's claims/disputes metrics for a specific period,
 * including the claim rate and absolute value used in reputation scoring.
 */
class Claims
{
    /** The claims period (e.g., "365 days"). */
    public ?string $period;

    /** The claims rate (percentage). */
    public ?float $rate;

    /** The claims value. */
    public ?float $value;
}
