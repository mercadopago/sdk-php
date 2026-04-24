<?php

namespace MercadoPago\Resources\Customer;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a single customer entry within a search results response.
 *
 * Used as the element type when deserializing the array returned by the customer
 * search endpoint. Contains the same profile fields as {@see \MercadoPago\Resources\Customer}
 * but is used specifically inside {@see \MercadoPago\Resources\CustomerSearch}.
 *
 * @see \MercadoPago\Client\Customer\CustomerClient
 */
class CustomerSearchResult
{
    use Mapper;

    /** Unique customer identifier assigned by MercadoPago. */
    public ?string $id;

    /** Customer's email address. */
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
    public array $cards;

    /** Registered addresses associated with this customer. */
    public array $addresses;

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
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
