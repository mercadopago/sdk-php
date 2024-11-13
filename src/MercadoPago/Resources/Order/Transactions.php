<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

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
