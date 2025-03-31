<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

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
