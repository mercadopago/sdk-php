<?php

namespace MercadoPago\Resources\Payment;

/** Shipments class. */
class Shipments
{
    /** Receiver Address. */
    public $receiver_address;

    /**
     * Method responsible for mapping class attributes.
     */
    public static function map(string $field)
    {
        $map = [
            "receiver_address" => "MercadoPago\Resources\Payment\ReceiverAddress"
        ];

        foreach ($map as $key => $value) {
            if ($key === $field) {
                return $value;
            }
        }
    }
}
