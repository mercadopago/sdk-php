<?php

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Transactions class. */
class Transactions
{
    /** Class mapper. */
    use Mapper;

    /** Payments. */
    public ?array $payments;

    /** Refunds. */
    public ?array $refunds;

    private $map = [
        "payments" => "MercadoPago\Resources\Order\Payments",
        "refunds" => "MercadoPago\Resources\Order\Refunds",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
