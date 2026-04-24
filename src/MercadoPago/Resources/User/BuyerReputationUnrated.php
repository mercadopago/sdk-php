<?php

namespace MercadoPago\Resources\User;

/**
 * User Buyer Reputation Unrated Transactions resource.
 *
 * Tracks transactions where the buyer did not provide a rating,
 * broken down by paid and total counts.
 */
class BuyerReputationUnrated
{
    /** The number of paid unrated transactions. */
    public $paid;

    /** The total number of unrated transactions. */
    public $total;
}
