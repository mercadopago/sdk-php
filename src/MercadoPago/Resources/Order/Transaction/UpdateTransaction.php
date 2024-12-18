<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order\Transaction;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** UpdateTransaction class. */
class UpdateTransaction extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Transaction ID. */
    public ?string $id;

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
