<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents shipping information for a MercadoPago order.
 *
 * Contains shipping mode, cost, free shipping options, and delivery address
 * for physical goods in the order.
 *
 * @see \MercadoPago\Resources\Order
 */
class Shipment
{
    /** Class mapper. */
    use Mapper;

    /** Shipping mode. "custom": seller-defined shipping. "not_specified": no specification. */
    public ?string $mode;

    /** Whether the buyer can pick up the product in person. When true, disables shipping cost calculation. */
    public ?bool $local_pickup;

    /** Shipping cost when mode is "custom". Must be >= 0. */
    public ?string $cost;

    /** When true, shipping is free for the buyer. Cannot be combined with cost > 0. */
    public ?bool $free_shipping;

    /** List of free shipping method IDs available to the buyer. */
    public ?array $free_methods;

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
