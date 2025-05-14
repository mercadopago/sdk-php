<?php

/** API version: acd67b14-97c4-4a4a-840d-0a018c09654f */

namespace MercadoPago\Resources\Order;

/** Payer class. */
class Payer
{
    /** Customer ID. */
    public ?string $customer_id;

    /** Customer Email */
    public ?string $email;

    /** EntityType */
    public ?string $entity_type;

    /** First name. */
    public ?string $first_name;

    /** Last name. */
    public ?string $last_name;

    /** Phone. */
    public ?Phone $phone;

    /** Identification. */
    public ?Identification $identification;

    /** Address. */
    public ?Address $address;

    private $map = [
        "phone" => "MercadoPago\Resources\Common\Phone",
        'identification' => "MercadoPago\Resources\Common\Identification",
        'address' => "MercadoPago\Resources\Common\Address",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }

}
