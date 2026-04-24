<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Shipping Option resource.
 *
 * Represents a selectable shipping option for a merchant order shipment.
 * Includes cost, carrier method, estimated delivery time, and shipping speed details.
 *
 * Fields are mapped to nested DTOs:
 * - estimated_delivery -> {@see \MercadoPago\Resources\MerchantOrder\ShippingEstimatedDelivery}
 * - speed -> {@see \MercadoPago\Resources\MerchantOrder\ShippingSpeed}
 */
class ShippingOption
{
    /** Shipping option ID. */
    public ?int $id;

    /** Net cost absorbed by the receiver. */
    public ?float $cost;

    /** Currency ID. */
    public ?string $currency_id;

    /** Estimated delivery time information. */
    public array|object|null $estimated_delivery;

    /** Net cost of the shipping. */
    public ?float $list_cost;

    /** Option name. */
    public ?string $name;

    /** Shipping method ID. */
    public ?int $shipping_method_id;

    /** Shipping time information. */
    public array|object|null $speed;

    private $map = [
      "estimated_delivery" => "MercadoPago\Resources\MerchantOrder\ShippingEstimatedDelivery",
      "speed" => "MercadoPago\Resources\MerchantOrder\ShippingSpeed",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
