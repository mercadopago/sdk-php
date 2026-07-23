<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for creating an order (`POST /v1/orders`).
 *
 * Optional, backward-compatible alternative to passing a plain array to
 * {@see \MercadoPago\Client\Order\OrderClient::create()}. All fields are optional
 * and null/unset fields are omitted from the serialized body; nested objects and
 * arrays of objects are converted recursively (see {@see self::toArray()}), so the
 * resulting JSON is identical to the equivalent dynamic array.
 *
 * @see https://www.mercadopago.com/developers/en/reference/order/_v1_orders/post
 */
final class OrderCreateRequest implements JsonSerializable
{
    /**
     * @param array<int,OrderItemRequest>|null $items List of typed item requests.
     * @param array<string,mixed>|null $additional_info Free-form additional info block, kept as-is.
     */
    public function __construct(
        public readonly ?string $type = null,
        public readonly ?string $external_reference = null,
        public readonly ?string $total_amount = null,
        public readonly ?string $currency = null,
        public readonly ?string $capture_mode = null,
        public readonly ?string $processing_mode = null,
        public readonly ?string $description = null,
        public readonly ?string $marketplace = null,
        public readonly ?string $marketplace_fee = null,
        public readonly ?string $expiration_time = null,
        public readonly ?string $checkout_available_at = null,
        public readonly ?OrderTransactionRequest $transactions = null,
        public readonly ?OrderPayerRequest $payer = null,
        public readonly ?array $items = null,
        public readonly ?OrderConfigRequest $config = null,
        public readonly ?OrderShipmentRequest $shipment = null,
        public readonly ?array $additional_info = null,
        public readonly ?OrderIntegrationDataRequest $integration_data = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "type" => $this->type,
            "external_reference" => $this->external_reference,
            "total_amount" => $this->total_amount,
            "currency" => $this->currency,
            "capture_mode" => $this->capture_mode,
            "processing_mode" => $this->processing_mode,
            "description" => $this->description,
            "marketplace" => $this->marketplace,
            "marketplace_fee" => $this->marketplace_fee,
            "expiration_time" => $this->expiration_time,
            "checkout_available_at" => $this->checkout_available_at,
            "transactions" => $this->transactions?->toArray(),
            "payer" => $this->payer?->toArray(),
            "items" => $this->items === null
                ? null
                : array_map(fn (OrderItemRequest $i) => $i->toArray(), $this->items),
            "config" => $this->config?->toArray(),
            "shipment" => $this->shipment?->toArray(),
            "additional_info" => $this->additional_info,
            "integration_data" => $this->integration_data?->toArray(),
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
