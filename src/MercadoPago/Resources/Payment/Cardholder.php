<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the cardholder (owner of the payment card) in the MercadoPago API.
 *
 * Contains the cardholder's name and identification document as printed on
 * the card or registered with the issuer. Nested within {@see Card} and
 * {@see \MercadoPago\Resources\CardToken}.
 */
class Cardholder
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Full name of the cardholder as it appears on the card. */
    public ?string $name;

    /** @var \MercadoPago\Resources\Common\Identification|array|null Cardholder's identification document (type and number). */
    public array|object|null $identification;

    private $map = [
        "identification" => "MercadoPago\Resources\Payment\Identification"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
