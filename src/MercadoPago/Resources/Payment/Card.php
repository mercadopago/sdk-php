<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Card class. */
class Card
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

    /** Country Card. */
    public ?string $country;

    /** Card's owner data. */
    public array|object|null $cardholder;

    /** Bin. */
    public ?string $bin;

    /** Tags. */
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
