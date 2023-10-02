<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** PaymentMethod class. */
class PaymentMethodData
{
    /** Class mapper. */
    use Mapper;

    /** Payment rules. */
    public array|object|null $rules;

    private $map = [
        "rules" => "MercadoPago\Resources\Payment\PaymentMethodRules",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
