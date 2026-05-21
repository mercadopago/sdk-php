<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the payer (buyer) of a payment in the MercadoPago API.
 *
 * Contains the payer's identity, contact information, and identification documents.
 * This is the primary payer object nested within {@see \MercadoPago\Resources\Payment}.
 *
 * @see AdditionalInfoPayer for supplementary payer details sent in additional_info.
 */
class Payer
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Payer type identifier (e.g. "customer", "registered", "guest"). Mandatory when the payer is a saved Customer. */
    public ?string $type;

    /** Unique payer identifier in MercadoPago. */
    public ?string $id;

    /** Payer's email address. */
    public ?string $email;

    /** @var \MercadoPago\Resources\Common\Identification|array|null Payer's identification document (e.g. CPF, DNI). */
    public array|object|null $identification;

    /** Payer's given/first name. */
    public ?string $first_name;

    /** Payer's family/last name. */
    public ?string $last_name;

    /** Entity type for bank transfer payments (e.g. "individual", "association"). */
    public ?string $entity_type;

    /** @var \MercadoPago\Resources\Common\Phone|array|null Payer's contact phone number. */
    public array|object|null $phone;

    /** Operator identifier when the payment is initiated by an operator on behalf of the payer. */
    public ?string $operator_id;

    private $map = [
        "identification" => "MercadoPago\Resources\Common\Identification",
        "phone" => "MercadoPago\Resources\Common\Phone"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
