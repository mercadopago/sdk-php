<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Shipments class. */
class Shipments
{
    /** Receiver Address. */
    public $receiver_address;

    /** Class mapper. */
    use Mapper;

    private $map = [
        "receiver_address" => "MercadoPago\Resources\Payment\ReceiverAddress"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap()
    {
        return $this->map;
    }
}
