<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/**
 * User Seller Reputation resource.
 *
 * Represents the selling reputation of a MercadoLibre user, including their
 * seller level, power seller status, transaction history, and performance metrics.
 *
 * Fields are mapped to nested DTOs:
 * - transactions -> {@see \MercadoPago\Resources\User\Transactions}
 * - metrics -> {@see \MercadoPago\Resources\User\Metrics}
 */
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
