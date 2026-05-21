<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/**
 * User Seller Metrics resource.
 *
 * Aggregates the seller's key performance metrics used for reputation scoring,
 * including sales volume, claims rate, delayed handling time, and cancellation rate.
 *
 * Fields are mapped to nested DTOs:
 * - sales -> {@see \MercadoPago\Resources\User\Sales}
 * - claims -> {@see \MercadoPago\Resources\User\Claims}
 * - delayed_handling_time -> {@see \MercadoPago\Resources\User\DelayedHandlingTime}
 * - cancellations -> {@see \MercadoPago\Resources\User\Cancellations}
 */
class Metrics
{
    /** Class mapper. */
    use Mapper;

    /** User sales metrics for a specific period. */
    public array|object|null $sales;

    /** User claims metrics for a specific period. */
    public array|object|null $claims;

    /** User delayed handling time metrics for a specific period. */
    public array|object|null $delayed_handling_time;

    /** User cancellations metrics for a specific period. */
    public array|object|null $cancellations;

    public $map = [
        "sales" => "MercadoPago\Resources\User\Sales",
        "claims" => "MercadoPago\Resources\User\Claims",
        "delayed_handling_time" => "MercadoPago\Resources\User\DelayedHandlingTime",
        "cancellations" => "MercadoPago\Resources\User\Cancellations",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
