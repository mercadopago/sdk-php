<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/** SellerReputation class. */
class SellerReputation
{
    /** Class mapper. */
    use Mapper;

    /** The seller's level ID (null in this case). */
    public ?string $level_id;

    /** The power seller status (null in this case). */
    public ?string $power_seller_status;

    /** User transaction metrics and statistics. */
    public array|object|null $transactions;

    /** User transaction metrics. */
    public array|object|null $metrics;

    public $map = [
        "transactions" => "MercadoPago\Resources\User\Transactions",
        "metrics" => "MercadoPago\Resources\User\Metrics",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
