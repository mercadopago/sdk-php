<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents a saved customer in the MercadoPago platform.
 *
 * Stores payer information (email, identification, address) and saved cards
 * for streamlined checkout experiences. Customers can have multiple cards and
 * addresses associated with their profile.
 *
 * @see \MercadoPago\Client\Customer\CustomerClient
 */
class Customer extends MPResource
{
    use Mapper;

    /** Unique customer identifier assigned by MercadoPago. */
    public ?string $id;

    /** Customer's email address, used as the primary lookup key. */
    public ?string $email;

    /** Customer's first name. */
    public ?string $first_name;

    /** Customer's last name. */
    public ?string $last_name;

    /** Date when the customer registered on the merchant's platform (ISO 8601). */
    public ?string $date_registered;

    /** Free-text description or notes about the customer. */
    public ?string $description;

    /** Timestamp when this customer record was created in MercadoPago (ISO 8601). */
    public ?string $date_created;

    /** Timestamp of the last update to this customer record (ISO 8601). */
    public ?string $date_last_updated;

    /** ID of the customer's default card used for payments. */
    public ?string $default_card;

    /** ID of the customer's default shipping/billing address. */
    public ?string $default_address;

    /** Whether this record belongs to a production (true) or test (false) environment. */
    public ?bool $live_mode;

    /** Internal MercadoPago user ID linked to this customer. */
    public ?int $user_id;

    /** ID of the merchant (seller) who owns this customer record. */
    public ?int $merchant_id;

    /** ID of the OAuth application that created this customer. */
    public ?int $client_id;

    /** Customer status (e.g., "active"). */
    public ?string $status;

    /** Saved payment cards associated with this customer. */
    public array $cards = [];

    /** Registered addresses associated with this customer. */
    public array $addresses = [];

    /** Customer's phone number details. */
    public array|object|null $phone;

    /** Customer's personal identification document (e.g., CPF, DNI). */
    public array|object|null $identification;

    /** Customer's primary address. */
    public array|object|null $address;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "phone" => "MercadoPago\Resources\Common\Phone",
        "identification" => "MercadoPago\Resources\Common\Identification",
        "address" => "MercadoPago\Resources\Common\Address",
        "addresses" => "MercadoPago\Resources\Common\Address",
        "cards" => "MercadoPago\Resources\CustomerCard",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
