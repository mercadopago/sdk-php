<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for a subscription sequence.
 *
 * Serializes to the `subscription_sequence` object nested under `subscription_data`.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderSubscriptionSequenceRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?int $number = null,
        public readonly ?int $total = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "number" => $this->number,
            "total" => $this->total,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
