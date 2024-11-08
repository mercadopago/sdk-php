<?php

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Refunds class. */
class Refunds
{
    /** Class mapper. */
    use Mapper;

    /** Refund ID. */
    public ?string $id;

    /** Amount. */
    public ?string $amount;

    /** Reference. */
    public array|object|null $reference;

    private $map = [
        "reference" => "MercadoPago\Resources\Order\RefundReference",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
