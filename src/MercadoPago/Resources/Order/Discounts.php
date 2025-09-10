<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Discounts class. */
class Discounts
{
    /** Class mapper. */
    use Mapper;

    /** Payment methods. */
    public ?array $payment_methods;

    private $map = [
        "payment_methods" => "MercadoPago\Resources\Order\PaymentMethodDiscount",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
