<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Payer class. */
class Payer
{
    /** Class mapper. */
    use Mapper;

    /** Payer's identification type (mandatory if the payer is a Customer). */
    public ?string $type;

    /** Payer's ID. */
    public ?string $id;

    /** Email of the payer. */
    public ?string $email;

    /** Payer's personal identification. */
    public array|object|null $identification;

    /** Payer's first name. */
    public ?string $first_name;

    /** Payer's last name. */
    public ?string $last_name;

    /** Payer's entity type (only for bank transfers). */
    public ?string $entity_type;

    /** Phone. */
    public array|object|null $phone;

    /** Operator ID */
    public ?string $operator_id;

    /** Buyer registration date on your website */
    public ?string $registration_date;

    public ?string $is_prime_user;

    public ?string $is_first_purchase_online;

    public ?string $last_purchase;

    public ?string $authentication_type;


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
