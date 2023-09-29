<?php

namespace MercadoPago\Resources\Customer;

use MercadoPago\Serialization\Mapper;

/** Cardholder class */
class Cardholder
{
    /** Class mapper. */
    use Mapper;

    /** Name of cardholder. */
    public ?string $name;

    /** Identification of cardholder. */
    public array|object|null $identification;

    private $map = [
        "identification" => "MercadoPago\Resources\Common\Identification",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }

}
