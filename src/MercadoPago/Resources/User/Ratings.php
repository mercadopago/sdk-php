<?php

namespace MercadoPago\Resources\User;

/**
 * User Seller Ratings resource.
 *
 * Represents the seller's rating distribution from completed transactions,
 * broken down into negative, neutral, and positive feedback counts.
 */
class Ratings
{
    /** The number of negative ratings. */
    public ?int $negative;

    /** The number of neutral ratings. */
    public ?int $neutral;

    /** The number of positive ratings. */
    public ?int $positive;
}
