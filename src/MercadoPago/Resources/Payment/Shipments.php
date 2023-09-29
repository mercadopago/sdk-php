<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Shipments class. */
class Shipments
{
    /** Class mapper. */
    use Mapper;

    /** Receiver Address. */
    public array|object|null $receiver_address;

    private $map = [
        "receiver_address" => "MercadoPago\Resources\Payment\ReceiverAddress"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
