<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for an address.
 *
 * Used both for `payer.address` and `shipment.address`. The union of fields from
 * both locations is supported; unset fields are omitted from the resulting array,
 * so each usage only emits the keys it sets (see {@see self::toArray()}).
 */
final class OrderAddressRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $zip_code = null,
        public readonly ?string $street_name = null,
        public readonly ?string $street_number = null,
        public readonly ?string $neighborhood = null,
        public readonly ?string $city = null,
        public readonly ?string $state = null,
        public readonly ?string $complement = null,
        public readonly ?string $floor = null,
        public readonly ?string $apartment = null,
        public readonly ?string $country = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "zip_code" => $this->zip_code,
            "street_name" => $this->street_name,
            "street_number" => $this->street_number,
            "neighborhood" => $this->neighborhood,
            "city" => $this->city,
            "state" => $this->state,
            "complement" => $this->complement,
            "floor" => $this->floor,
            "apartment" => $this->apartment,
            "country" => $this->country,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
