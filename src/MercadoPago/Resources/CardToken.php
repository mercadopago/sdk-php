<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Card Token class. */
class CardToken extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Id of the card. */
    public ?string $id;

    /** Last four digits of card number. */
    public ?string $last_four_digits;

    /** First six digit of card number. */
    public ?string $first_six_digits;

    /** Card expiration year. */
    public ?int $expiration_year;

    /** Card expiration month. */
    public ?int $expiration_month;

    /** Creation date of card. */
    public ?string $date_created;

    /** Last update of data from the card. */
    public ?string $date_last_updated;

    /** Card's owner data. */
    public array|object|null $cardholder;

    /** Card ID. */
    public ?int $card_id;

    /** Current status of card. E.g. active. */
    public ?string $status;

    /** Date token expires. */
    public ?string $date_due;

    /** Flag indicating if Luhn validation is used. */
    public ?bool $luhn_validation;

    /** Flag indicating if this is a production card token. */
    public ?bool $live_mode;

    /** Require esc. */
    public ?bool $require_esc;

    /** Security code of the card. */
    public ?int $card_number_length;

    /** Security code of the card. */
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
