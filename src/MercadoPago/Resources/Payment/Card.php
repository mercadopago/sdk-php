<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the card details associated with a card-based payment in the MercadoPago API.
 *
 * Contains masked card data (BIN, last four digits), expiration, and cardholder info.
 * Nested within the {@see \MercadoPago\Resources\Payment} response for credit/debit card payments.
 */
class Card
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Unique identifier of the card (if stored/saved). */
    public ?string $id;

    /** Last four digits of the card number (for display/verification). */
    public ?string $last_four_digits;

    /** First six digits (BIN) of the card number, identifying the issuer and card type. */
    public ?string $first_six_digits;

    /** Four-digit expiration year of the card. */
    public ?int $expiration_year;

    /** Two-digit expiration month of the card (1-12). */
    public ?int $expiration_month;

    /** ISO 8601 timestamp when the card record was created. */
    public ?string $date_created;

    /** ISO 8601 timestamp of the last update to the card record. */
    public ?string $date_last_updated;

    /** ISO 3166-1 country code where the card was issued. */
    public ?string $country;

    /** @var Cardholder|array|null Name and identification of the cardholder. */
    public array|object|null $cardholder;

    /** Bank Identification Number (first 6-8 digits of the card). */
    public ?string $bin;

    /** Internal tags associated with the card. */
    public array|object|null $tags;


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
