<?php

namespace MercadoPago\Resources\Customer;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the holder of a payment card.
 *
 * Contains the cardholder's name as printed on the card and their personal
 * identification document, used for fraud prevention and payment validation.
 */
class Cardholder
{
    use Mapper;

    /** Full name of the cardholder as printed on the card. */
    public ?string $name;

    /** Cardholder's personal identification document (e.g., CPF, DNI). */
    public array|object|null $identification;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "identification" => "MercadoPago\Resources\Common\Identification",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }

}
