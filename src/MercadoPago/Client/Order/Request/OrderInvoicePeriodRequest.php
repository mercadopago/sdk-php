<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for an invoice period.
 *
 * Serializes to the `invoice_period` object nested under `subscription_data`.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderInvoicePeriodRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?int $period = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "type" => $this->type,
            "period" => $this->period,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
