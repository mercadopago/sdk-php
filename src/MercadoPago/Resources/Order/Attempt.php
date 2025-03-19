<?php

/** API version: 950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Attempt class. */
class Attempt
{
    /** Class mapper. */
    use Mapper;

    /** Attempt ID. */
    public ?string $id;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /** Payment method. */
    public array|object|null $payment_method;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethod",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
