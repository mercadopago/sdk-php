<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

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
