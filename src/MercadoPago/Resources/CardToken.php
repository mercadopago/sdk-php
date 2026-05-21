<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents a tokenized card in the MercadoPago API.
 *
 * A card token is a secure, temporary representation of card data generated
 * by MercadoPago.js on the client side. It is used to create payments without
 * transmitting sensitive card details through the integrator's server.
 * Returned by {@see \MercadoPago\Client\CardToken\CardTokenClient} operations.
 */
class CardToken extends MPResource
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Unique token identifier used to reference this card token in payment requests. */
    public ?string $id;

    /** Last four digits of the card number (for display/verification purposes). */
    public ?string $last_four_digits;

    /** First six digits (BIN) of the card number, used to identify the issuer and card type. */
    public ?string $first_six_digits;

    /** Four-digit expiration year of the card. */
    public ?int $expiration_year;

    /** Two-digit expiration month of the card (1-12). */
    public ?int $expiration_month;

    /** ISO 8601 timestamp when the token was created. */
    public ?string $date_created;

    /** ISO 8601 timestamp of the last update to the token. */
    public ?string $date_last_updated;

    /** @var \MercadoPago\Resources\Payment\Cardholder|array|null Cardholder name and identification data. */
    public array|object|null $cardholder;

    /** Saved card identifier if the token was generated from a stored card. */
    public ?int $card_id;

    /** Current status of the token (e.g. "active"). */
    public ?string $status;

    /** ISO 8601 timestamp when the token expires and can no longer be used. */
    public ?string $date_due;

    /** Whether the card number passed Luhn algorithm validation. */
    public ?bool $luhn_validation;

    /** Whether this token was created in production (true) or sandbox (false). */
    public ?bool $live_mode;

    /** Whether the token requires ESC (E2E Security Code) for processing. */
    public ?bool $require_esc;

    /** Total number of digits in the card number. */
    public ?int $card_number_length;

    /** Number of digits in the card's security code (CVV/CVC). */
    public ?int $security_code_length;


    private $map = [
        "cardholder" => "MercadoPago\Resources\Payment\Cardholder"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
