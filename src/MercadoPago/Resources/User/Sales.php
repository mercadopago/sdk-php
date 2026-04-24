<?php

namespace MercadoPago\Resources\User;

/**
 * User Seller Sales Metric resource.
 *
 * Represents the seller's completed sales count for a specific period,
 * used as part of the overall seller reputation scoring.
 */
class Sales
{
    /** The sales period (e.g., "365 days"). */
    public ?string $period;

    /** The number of completed sales. */
    public ?int $completed;
}
