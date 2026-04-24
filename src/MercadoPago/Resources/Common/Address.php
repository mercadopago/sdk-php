<?php

namespace MercadoPago\Resources\Common;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a physical address associated with a payer or shipment in the MercadoPago API.
 *
 * Used as a nested DTO within payer information, additional info, and shipment details
 * to describe street-level location data.
 *
 * @see \MercadoPago\Resources\Payment\ReceiverAddress for the extended shipment address variant.
 */
class Address
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

    /** @var City|array|null City information associated with this address. */
    public array|object|null $city;

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
}
