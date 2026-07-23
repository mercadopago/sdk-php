<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for the order shipment.
 *
 * Serializes to the `shipment` object at the order root. Null fields are omitted
 * and the nested address is converted recursively (see {@see self::toArray()}).
 */
final class OrderShipmentRequest implements JsonSerializable
{
    /**
     * @param array<int,array<string,mixed>>|null $free_methods List of free-shipping methods, e.g. [["id" => 1]].
     */
    public function __construct(
        public readonly ?string $mode = null,
        public readonly ?bool $local_pickup = null,
        public readonly ?string $cost = null,
        public readonly ?bool $free_shipping = null,
        public readonly ?array $free_methods = null,
        public readonly ?OrderAddressRequest $address = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "mode" => $this->mode,
            "local_pickup" => $this->local_pickup,
            "cost" => $this->cost,
            "free_shipping" => $this->free_shipping,
            "free_methods" => $this->free_methods,
            "address" => $this->address?->toArray(),
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
