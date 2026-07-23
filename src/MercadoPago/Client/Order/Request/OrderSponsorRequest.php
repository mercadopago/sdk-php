<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for an integration sponsor.
 *
 * Serializes to the `sponsor` object nested under `integration_data`.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderSponsorRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $id = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "id" => $this->id,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
