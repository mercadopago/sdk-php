<?php

namespace MercadoPago\Resources\Common;

use JsonSerializable;
use MercadoPago\Serialization\Mapper;

/**
 * Represents a physical address associated with a payer or shipment in the MercadoPago API.
 *
 * Used as a nested DTO within payer information, additional info, and shipment details
 * to describe street-level location data. Also used as a typed request object when
 * building order or payment request bodies.
 *
 * @see \MercadoPago\Resources\Payment\ReceiverAddress for the extended shipment address variant.
 */
class Address implements JsonSerializable
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Unique identifier of the address. */
    public ?string $id;

    /** Postal/ZIP code of the address. */
    public ?string $zip_code;

    /** Name of the street. */
    public ?string $street_name;

    /** House or building number on the street. */
    public ?string $street_number;

    /** Neighborhood or district name. */
    public ?string $neighborhood;

    /** State or province name. */
    public ?string $state;

    /** Additional address details (e.g. apartment, suite, floor). */
    public ?string $complement;

    /** Floor number within a building. */
    public ?string $floor;

    /** Apartment or unit identifier within a floor. */
    public ?string $apartment;

    /** Country name or code. Used in order request bodies. */
    public ?string $country;

    /** @var City|string|array|null City name (string in requests) or City object (in responses). */
    public string|array|object|null $city;

    private $map = [
        "city" => "MercadoPago\Resources\Common\City"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        $city = $this->city instanceof City ? $this->city->name ?? null : $this->city;
        return array_filter([
            "zip_code" => $this->zip_code,
            "street_name" => $this->street_name,
            "street_number" => $this->street_number,
            "neighborhood" => $this->neighborhood,
            "city" => $city,
            "state" => $this->state,
            "complement" => $this->complement,
            "floor" => $this->floor,
            "apartment" => $this->apartment,
            "country" => $this->country,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
