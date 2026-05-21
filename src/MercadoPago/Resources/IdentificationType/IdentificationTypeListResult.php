<?php

namespace MercadoPago\Resources\IdentificationType;

/**
 * Represents a single identification type entry within the identification types list response.
 *
 * Each entry describes a government-issued document category accepted for payment
 * processing in a given country (e.g., CPF in Brazil, DNI in Argentina, CURP in Mexico).
 * Includes validation constraints (min/max length) for the document number.
 *
 * @see \MercadoPago\Client\IdentificationType\IdentificationTypeClient
 */
class IdentificationTypeListResult
{
    /** Identification type code (e.g., "CPF", "DNI", "CURP"). */
    public ?string $id;

    /** Human-readable name of the identification type (e.g., "CPF", "DNI", "CURP"). */
    public ?string $name;

    /** Category of identification document (e.g., "number"). */
    public ?string $type;

    /** Minimum number of characters allowed for this identification number. */
    public ?int $min_length;

    /** Maximum number of characters allowed for this identification number. */
    public ?int $max_length;
}
