<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for a payer identification.
 *
 * Serializes to the `identification` object nested under `payer`.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderIdentificationRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $number = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "type" => $this->type,
            "number" => $this->number,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
