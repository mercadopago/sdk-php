<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Refund class. */
class Refund
{
    /** Class mapper. */
    use Mapper;

    /** Refund ID. */
    public ?string $id;

    /** Transaction ID. */
    public ?string $transaction_id;

    /** Reference ID. */
    public ?string $reference_id;

    /** Amount. */
    public ?string $amount;

    /** Status. */
    public ?string $status;

    /** Items. */
    public ?array $items;

    private $map = [
        "transactions" => "MercadoPago\Resources\Order\Transactions",
        "items" => "MercadoPago\Resources\Order\Items",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
