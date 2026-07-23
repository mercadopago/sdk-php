<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for a payer phone.
 *
 * Serializes to the `phone` object nested under `payer`.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderPhoneRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $area_code = null,
        public readonly ?string $number = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "area_code" => $this->area_code,
            "number" => $this->number,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
