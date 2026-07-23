<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for subscription data.
 *
 * Serializes to the `subscription_data` object nested under a payment. Null fields
 * are omitted and nested objects (subscription_sequence, invoice_period) are
 * converted recursively (see {@see self::toArray()}).
 */
final class OrderSubscriptionDataRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $invoice_id = null,
        public readonly ?string $billing_date = null,
        public readonly ?OrderSubscriptionSequenceRequest $subscription_sequence = null,
        public readonly ?OrderInvoicePeriodRequest $invoice_period = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "invoice_id" => $this->invoice_id,
            "billing_date" => $this->billing_date,
            "subscription_sequence" => $this->subscription_sequence?->toArray(),
            "invoice_period" => $this->invoice_period?->toArray(),
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
