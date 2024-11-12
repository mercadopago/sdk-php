<?php

/** API version: 54cea3ac-c258-4a6f-aea9-988e641cff30 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Shipment class. */
class Shipment
{
    /** Class mapper. */
    use Mapper;

    /** Width. */
    public ?int $width;

    /** Height. */
    public ?int $height;

    /** Express shipment. */
    public ?bool $express_shipment;

    /** Pick up on seller. */
    public ?bool $pick_up_on_seller;

    /** Receiver address. */
    public array|object|null $receiver_address;

    private $map = [
        "receiver_address" => "MercadoPago\Resources\Order\ReceiverAddress",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
