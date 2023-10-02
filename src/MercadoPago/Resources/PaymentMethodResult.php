<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** PaymentMethodResult class. */
class PaymentMethodResult extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Payment Method Result data. */
    public array|object|null $data;

    private $map = [
        "data" => "MercadoPago\Resources\PaymentMethod\PaymentMethodListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
