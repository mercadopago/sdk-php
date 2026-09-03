<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Order Refund resource.
 *
 * Represents the response data returned when refunding an order via the Orders API.
 * Contains the refund ID, current status, status detail, and the list of transactions
 * affected by the refund operation.
 *
 * @property array|object|null $transactions Transaction details, mapped to {@see \MercadoPago\Resources\Order\Transactions}.
 *
 * @see \MercadoPago\Client\Order\OrderClient
 */
class OrderRefund extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** The refund ID. */
    public ?string $id;

    /** The current status of the refund (e.g., "refunded", "pending"). */
    public ?string $status;

    /** Additional detail about the refund status. */
    public ?string $status_detail;

    /** The transactions associated with this refund. */
    public array|object|null $transactions;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "transactions" => "MercadoPago\Resources\Order\Transactions",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}