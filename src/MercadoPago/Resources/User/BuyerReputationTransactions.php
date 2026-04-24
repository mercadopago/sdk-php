<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/**
 * User Buyer Reputation Transactions resource.
 *
 * Provides a breakdown of a buyer's transaction history for a given period,
 * including cancelled, completed, not-yet-rated, and unrated transaction counts.
 *
 * Fields are mapped to nested DTOs:
 * - canceled -> {@see \MercadoPago\Resources\User\BuyerReputationCancelled}
 * - not_yet_rated -> {@see \MercadoPago\Resources\User\BuyerReputationNotYetRated}
 * - unrated -> {@see \MercadoPago\Resources\User\BuyerReputationUnrated}
 */
class BuyerReputationTransactions
{
    /** Class mapper. */
    use Mapper;

    /** User metrics for canceled transactions. */
    public array|object|null $canceled;

    /** The number of completed transactions. */
    public $completed;

    /** User metrics for transactions not yet rated. */
    public array|object|null $not_yet_rated;

    /** The transaction period (e.g., "historic"). */
    public ?string $period;

    /** User metrics for unrated transactions. */
    public array|object|null $unrated;

    /** Total of transactions. */
    public $total;

    public $map = [
        "canceled" => "MercadoPago\Resources\User\BuyerReputationCancelled",
        "not_yet_rated" => "MercadoPago\Resources\User\BuyerReputationNotYetRated",
        "unrated" => "MercadoPago\Resources\User\BuyerReputationUnrated",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
