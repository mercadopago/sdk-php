<?php

/** API version: 54cea3ac-c258-4a6f-aea9-988e641cff30 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Payer class. */
class Payer
{
    /** Class mapper. */
    use Mapper;

    /** Email. */
    public ?string $email;

    /** First name. */
    public ?string $first_name;

    /** Last name. */
    public ?string $last_name;

    /** Authentication type. */
    public ?string $authentication_type;

    /** Registration date. */
    public ?string $registration_date;

    /** Last purchase. */
    public ?string $last_purchase;

    /** Entity type. */
    public ?string $entity_type;

    /** Is prime user. */
    public ?bool $is_prime_user;

    /** Is first purchase online. */
    public ?bool $is_first_purchase_online;

    /** Identification. */
    public array|object|null $identification;

    /** Phone. */
    public array|object|null $phone;

    /** Address. */
    public array|object|null $address;

    private $map = [
        "identification" => "MercadoPago\Resources\Common\Identification",
        "phone" => "MercadoPago\Resources\Order\Phone",
        "address" => "MercadoPago\Resources\Order\Address",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
