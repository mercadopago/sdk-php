<?php

namespace MercadoPago\Resources\User;

/**
 * User Buyer Reputation Cancelled Transactions resource.
 *
 * Tracks the number of cancelled transactions in a buyer's reputation,
 * distinguishing between paid-then-cancelled and total cancelled transactions.
 */
class BuyerReputationCancelled
{
    /** The number of paid canceled transactions. */
    public $paid;

    /** The total number of canceled transactions. */
    public $total;
}
