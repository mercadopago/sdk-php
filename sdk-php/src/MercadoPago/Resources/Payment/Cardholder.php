<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Cardholder class. */
class Cardholder
{
    /** Class mapper. */
    use Mapper;

    /** Cardholder Name. */
    public ?string $name;

    /** Cardholder identification. */
    public array|object|null $identification;

    private $map = [
        "identification" => "MercadoPago\Resources\Payment\Identification"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
