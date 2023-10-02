<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/** Transactions class. */
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
