<?php

namespace MercadoPago\Resources\Customer;

use MercadoPago\Serialization\Mapper;

/** Customer class. */
class CustomerSearchResult
{
    /** Class mapper. */
    use Mapper;

    /** Id of the customer. */
    public ?string $id;

    /** Email of the customer. */
    public ?string $email;

    /** First name of the customer. */
    public ?string $first_name;

    /** Last name of the customer. */
    public ?string $last_name;

    /** Date registered. */
    public ?string $date_registered;

    /** Description. */
    public ?string $description;

    /** Date created. */
    public ?string $date_created;

    /** Date Last_updated. */
    public ?string $date_last_updated;

    /** Default card. */
    public ?string $default_card;

    /** Default address. */
    public ?string $default_address;

    /** Flag indicating if this is a record from production or test environment. */
    public ?bool $live_mode;

    /** Id of the user. */
    public ?int $user_id;

    /** Id of the merchant. */
    public ?int $merchant_id;

    /** Id of the client. */
    public ?int $client_id;

    /** Status of the customer. */
    public ?string $status;

    /** List cards of the customer. */
    public array $cards;

    /** List addresses of the customer. */
    public array $addresses;

    /** Phone of the customer. */
    public array|object|null $phone;

    /** Identification of the customer. */
    public array|object|null $identification;

    /** Address of the customer. */
    public array|object|null $address;

    private $map = [
        "phone" => "MercadoPago\Resources\Common\Phone",
        "identification" => "MercadoPago\Resources\Common\Identification",
        "address" => "MercadoPago\Resources\Common\Address",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
