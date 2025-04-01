<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Config class. */
class Config
{
    /** Class mapper. */
    use Mapper;

    /** Payment method. */
    public array|object|null $payment_method;

    /** Online. */
    public array|object|null $online;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethodConfig",
        "online" => "MercadoPago\Resources\Order\OnlineConfig",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
