<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Transactions class. */
class Transactions extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Payments. */
    public ?array $payments;

    /** Refunds. */
    public ?array $refunds;

    private $map = [
        "payments" => "MercadoPago\Resources\Order\Payment",
        "refunds" => "MercadoPago\Resources\Order\Refund",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
