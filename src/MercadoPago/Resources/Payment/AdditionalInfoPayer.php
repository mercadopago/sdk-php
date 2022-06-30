<?php

namespace MercadoPago\Resources\Payment;

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

    /**
     * Method responsible for mapping class attributes.
     */
    public static function map(string $field)
    {
        $map = [
            "phone" => "MercadoPago\Resources\Payment\Phone",
            "address" => "MercadoPago\Resources\Payment\Address"
        ];

        foreach ($map as $key => $value) {
            if ($key === $field) {
                return $value;
            }
        }
    }
}
