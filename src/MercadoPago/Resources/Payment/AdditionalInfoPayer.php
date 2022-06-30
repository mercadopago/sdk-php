<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** AdditionalInfoPayer class. */
class AdditionalInfoPayer
{
    /** Payer's first name. */
    public $first_name;

    /** Payer's last name. */
    public $last_name;

    /** Payer's phone. */
    public $phone;

    /** Payer's address. */
    public $address;

    /** Date of registration of the payer on your site. */
    public $registration_date;

    /** Class mapper. */
    use Mapper;

    private $map = [
        "phone" => "MercadoPago\Resources\Payment\Phone",
        "address" => "MercadoPago\Resources\Payment\Address"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap()
    {
        return $this->map;
    }
}
