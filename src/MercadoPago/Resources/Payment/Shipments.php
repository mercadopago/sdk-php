<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents shipment information associated with a payment in the MercadoPago API.
 *
 * Contains the delivery address for the purchased items.
 * Nested within {@see AdditionalInfo}.
 */
class Shipments
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var ReceiverAddress|array|null Delivery address where the purchased items will be shipped. */
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
