<?php

namespace MercadoPago\Resources\Payment;

/** Cardholder class. */
class Cardholder
{
    /** Cardholder Name. */
    public $name;

    /** Cardholder identification. */
    public $identification;

    /**
     * Method responsible for mapping class attributes.
     */
    public static function map(string $field)
    {
        $map = [
            "identification" => "MercadoPago\Resources\Payment\Identification"
        ];

        foreach ($map as $key => $value) {
            if ($key === $field) {
                return $value;
            }
        }
    }
}
