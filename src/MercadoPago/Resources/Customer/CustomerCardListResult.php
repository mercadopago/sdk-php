<?php

namespace MercadoPago\Resources\Customer;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a single card entry within a customer's card list response.
 *
 * Used as the element type when deserializing the array returned by the
 * "list customer cards" endpoint. Mirrors the structure of {@see \MercadoPago\Resources\CustomerCard}
 * but is used specifically inside {@see \MercadoPago\Resources\CustomerCardResult}.
 *
 * @see \MercadoPago\Client\Customer\CustomerCardClient
 */
class CustomerCardListResult
{
    use Mapper;

    /** Unique card identifier assigned by MercadoPago. */
    public ?string $id;

    /** ID of the customer who owns this card. */
    public ?string $customer_id;

    /** Card expiration month (1-12). */
    public ?int $expiration_month;

    /** Card expiration year (four-digit). */
    public ?int $expiration_year;

    /** First six digits (BIN) of the card number, used to identify the issuer and card type. */
    public ?string $first_six_digits;

    /** Last four digits of the card number, used for display/identification. */
    public ?string $last_four_digits;

    /** Payment method associated with this card (e.g., Visa, Mastercard). */
    public array|object|null $payment_method;

    /** Security code (CVV/CVC) metadata, including length and card location. */
    public array|object|null $security_code;

    /** Financial institution that issued this card. */
    public array|object|null $issuer;

    /** Cardholder details (name and identification) as printed on the card. */
    public array|object|null  $cardholder;

    /** Timestamp when this card record was created (ISO 8601). */
    public ?string $date_created;

    /** Timestamp of the last update to this card record (ISO 8601). */
    public ?string $date_last_updated;

    /** Internal MercadoPago user ID associated with this card. */
    public ?string $user_id;

    /** Whether this record belongs to a production (true) or test (false) environment. */
    public ?bool $live_mode;

    /** Unique identifier for the tokenized card number. */
    public ?string $card_number_id;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "payment_method" => "MercadoPago\Resources\Customer\PaymentMethod",
        "security_code" => "MercadoPago\Resources\Customer\SecurityCode",
        "issuer" => "MercadoPago\Resources\Customer\Issuer",
        "cardholder" => "MercadoPago\Resources\Customer\Cardholder",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
