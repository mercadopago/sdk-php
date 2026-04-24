<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents shipping information for a MercadoPago order.
 *
 * Contains the delivery address details for physical goods in the order.
 *
 * @see \MercadoPago\Resources\Order
 */
class Shipment
{
    /** Class mapper. */
    use Mapper;

    /** Delivery address for the shipment. Maps to Address. */
    public array|object|null $address;

    private $map = [
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
