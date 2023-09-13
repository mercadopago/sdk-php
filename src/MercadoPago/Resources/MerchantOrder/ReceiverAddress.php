<?php

namespace MercadoPago\Resources\MerchantOrder;

use MercadoPago\Serialization\Mapper;

class ReceiverAddress
{
    /** Class mapper. */
    use Mapper;

    /** Receiver address ID. */
    public ?int $id;

    /** Street name and number of receiver address. */
    public ?string $address_line;

    /** Apartment. */
    public ?string $apartment;

    /** City information. */
    public array|object|null $city;

    /** State information. */
    public array|object|null $state;

    /** Country information. */
    public array|object|null $country;

    /** Comment about receiver address. */
    public ?string $comment;

    /** Contact information. */
    public ?string $contact;

    /** Postal code. */
    public ?string $zip_code;

    /** Street name. */
    public ?string $street_name;

    /** Street number. */
    public ?string $street_number;

    /** Floor. */
    public ?string $floor;

    /** Phone. */
    public ?string $phone;

    /** Latitude. */
    public ?string $latitude;

    /** Longitude. */
    public ?string $longitude;

    private $map = [
      "city" => "MercadoPago\Resources\MerchantOrder\ReceiverAddressCity",
      "state" => "MercadoPago\Resources\MerchantOrder\ReceiverAddressState",
      "country" => "MercadoPago\Resources\MerchantOrder\ReceiverAddressCountry",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
