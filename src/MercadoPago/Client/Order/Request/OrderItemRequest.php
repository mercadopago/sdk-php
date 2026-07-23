<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for an order item.
 *
 * Serializes to an entry of the `items` array at the order root.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderItemRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $title = null,
        public readonly ?string $type = null,
        public readonly ?bool $warranty = null,
        public readonly ?string $event_date = null,
        public readonly ?string $unit_price = null,
        public readonly ?string $external_code = null,
        public readonly ?string $category_id = null,
        public readonly ?string $description = null,
        public readonly ?string $picture_url = null,
        public readonly ?int $quantity = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "title" => $this->title,
            "type" => $this->type,
            "warranty" => $this->warranty,
            "event_date" => $this->event_date,
            "unit_price" => $this->unit_price,
            "external_code" => $this->external_code,
            "category_id" => $this->category_id,
            "description" => $this->description,
            "picture_url" => $this->picture_url,
            "quantity" => $this->quantity,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
