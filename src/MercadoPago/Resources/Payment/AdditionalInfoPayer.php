<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** AdditionalInfoPayer class. */
class AdditionalInfoPayer
{
    /** Class mapper. */
    use Mapper;

    /** Payer's first name. */
    public ?string $first_name;

    /** Payer's last name. */
    public ?string $last_name;

    /** Payer's phone. */
    public array|object|null $phone;

    /** Payer's address. */
    public array|object|null $address;

    /** Date of registration of the payer on your site. */
    public ?string $registration_date;

    private $map = [
        "phone" => "MercadoPago\Resources\Common\Phone",
        "address" => "MercadoPago\Resources\Common\Address"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
