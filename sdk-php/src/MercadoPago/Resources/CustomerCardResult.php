<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Customer Card Result class. */
class CustomerCardResult extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Customer Card Result data. */
    public array|object|null $data;

    private $map = [
        "data" => "MercadoPago\Resources\Customer\CustomerCardListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
