<?php

namespace MercadoPago\Resources\Payment;

/** PointOfInteraction class. */
class PointOfInteraction
{
    /** Type. */
    public $type;

    /** Sub type. */
    public $sub_type;

    /** Application data. */
    public $application_data;

    /** Transaction data. */
    public $transaction_data;

    /**
     * Method responsible for mapping class attributes.
     */
    public static function map(string $field)
    {
        $map = [
            "application_data" => "MercadoPago\Resources\Payment\ApplicationData",
            "transaction_data" => "MercadoPago\Resources\Payment\TransactionData",
        ];

        foreach ($map as $key => $value) {
            if ($key === $field) {
                return $value;
            }
        }
    }
}
