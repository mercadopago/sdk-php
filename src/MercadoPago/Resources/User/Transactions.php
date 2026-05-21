<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/**
 * User Seller Transactions resource.
 *
 * Provides a summary of the seller's transaction history for a given period,
 * including counts of cancelled, completed, and total transactions, along with
 * buyer rating distribution (positive, neutral, negative).
 *
 * @property array|object|null $ratings Rating breakdown, mapped to {@see \MercadoPago\Resources\User\Ratings}.
 */
class Transactions
{
    /** Class mapper. */
    use Mapper;

    /** The number of canceled transactions. */
    public ?int $canceled;

    /** The number of completed transactions. */
    public ?int $completed;

    /** The transaction period (e.g., "historic"). */
    public ?string $period;

    /** User ratings and feedback statistics. */
    public array|object|null $ratings;

    /** The total number of transactions. */
    public ?int $total;

    public $map = [
        "ratings" => "MercadoPago\Resources\User\Ratings",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
