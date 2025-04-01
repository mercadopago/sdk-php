<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order\Transaction;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** UpdateTransaction class. */
class UpdateTransaction extends MPResource
{
    /** Class mapper. */
    use Mapper;

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
