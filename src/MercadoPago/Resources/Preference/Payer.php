<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Serialization\Mapper;

/** Payer class. */
class Payer
{
    /** Class mapper. */
    use Mapper;

    /** Payer's name. */
    public ?string $name;

    /** Payer's surname. */
    public ?string $surname;

    /** Payer's email. */
    public ?string $email;

    /** Payer's phone. */
    public array|object|null $phone;

    /** Payer's identification. */
    public array|object|null $identification;

    /** Payer's address. */
    public array|object|null $address;

    /** Date of creation of the payer user. */
    public ?string $date_created;

    /** Date of the last purchase. */
    public ?string $last_purchase;

    /** Date of the last purchase. */
    public ?string $authentication_type;

    /** Is prime user. */
    public ?bool $is_prime_user;

    /** Is first purchase. */
    public ?bool $is_first_purchase_online;

    /** Date of Registration */
    public ?string $registration_date;

    private $map = [
        "identification" => "MercadoPago\Resources\Common\Identification",
        "phone" => "MercadoPago\Resources\Common\Phone",
        "address" => "MercadoPago\Resources\Common\Address",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
