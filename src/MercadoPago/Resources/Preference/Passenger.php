<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Serialization\Mapper;

/**
 * Preference Passenger resource.
 *
 * Represents a passenger associated with a travel-related preference item.
 *
 * Fields are mapped to common DTOs:
 * - identification -> {@see \MercadoPago\Resources\Common\Identification}
 */
class Passenger
{
    /** Class mapper. */
    use Mapper;

    /** Passenger's first name. */
    public ?string $first_name;

    /** Passenger's last name. */
    public ?string $last_name;

    /** @var \MercadoPago\Resources\Common\Identification|array|null Passenger's identification document. */
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
