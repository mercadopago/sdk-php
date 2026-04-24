<?php

namespace MercadoPago\Resources\User;

/**
 * User Buyer Reputation Not Yet Rated Transactions resource.
 *
 * Tracks transactions that the buyer has completed but has not yet
 * provided a rating for, broken down by paid count, total count, and units.
 */
class BuyerReputationNotYetRated
{
    /** The number of paid transactions not yet rated. */
    public $paid;

    /** The total number of transactions not yet rated. */
    public $total;

    /** The number of units not yet rated. */
    public $units;
}
