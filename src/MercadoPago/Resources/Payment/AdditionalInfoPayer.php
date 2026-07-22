<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents extended payer details provided as part of payment additional info.
 *
 * Supplements the main {@see Payer} data with contact details and registration
 * history that help MercadoPago improve fraud analysis.
 */
class AdditionalInfoPayer
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Payer's given/first name. */
    public ?string $first_name;

    /** Payer's family/last name. */
    public ?string $last_name;

    /** @var \MercadoPago\Resources\Common\Phone|array|null Payer's contact phone number. */
    public array|object|null $phone;

    /** @var \MercadoPago\Resources\Common\Address|array|null Payer's billing or residential address. */
    public array|object|null $address;

    /** ISO 8601 date when the payer registered on the integrator's platform. */
    public ?string $registration_date;

    /** Authentication type used by the payer. */
    public ?string $authentication_type;

    /** Whether the payer is a prime user. */
    public ?bool $is_prime_user;

    /** Whether this is the payer's first online purchase. */
    public ?bool $is_first_purchase_online;

    /** ISO 8601 date of the payer's last purchase. */
    public ?string $last_purchase;

    /** @var \MercadoPago\Resources\Common\Identification|array|null Payer's identification document. */
    public array|object|null $identification;

    private $map = [
        "phone" => "MercadoPago\Resources\Common\Phone",
        "address" => "MercadoPago\Resources\Common\Address",
        "identification" => "MercadoPago\Resources\Common\Identification",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
