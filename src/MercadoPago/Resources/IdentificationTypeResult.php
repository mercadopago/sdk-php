<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Wrapper resource for the list of identification types available in a country.
 *
 * Identification types represent government-issued document categories (e.g., CPF, DNI, CURP)
 * that buyers must provide during payment. The actual entries are contained in {@see $data}
 * as an array of {@see \MercadoPago\Resources\IdentificationType\IdentificationTypeListResult}.
 *
 * @see \MercadoPago\Client\IdentificationType\IdentificationTypeClient
 */
class IdentificationTypeResult extends MPResource
{
    use Mapper;

    /** Array of identification type entries returned by the API. */
    public array|object|null $data;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "data" => "MercadoPago\Resources\IdentificationType\IdentificationTypeListResult",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
