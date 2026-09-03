<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents an Order in the MercadoPago platform.
 *
 * Orders are comprehensive payment containers that support multiple transaction types
 * (payments, refunds), complex payer information, items, shipments, taxes, and discounts.
 * They can be processed in automatic or manual mode and support both online and offline flows.
 *
 * @property array|object|null $payer Payer information, mapped to {@see \MercadoPago\Resources\Order\Payer}.
 * @property array|object|null $transactions Transaction details, mapped to {@see \MercadoPago\Resources\Order\Transactions}.
 * @property array|object|null $items Order line items, mapped to {@see \MercadoPago\Resources\Order\Item}.
 * @property array|object|null $shipment Shipment information, mapped to {@see \MercadoPago\Resources\Order\Shipment}.
 * @property array|object|null $config Order configuration, mapped to {@see \MercadoPago\Resources\Order\Config}.
 * @property array|object|null $discounts Discount details, mapped to {@see \MercadoPago\Resources\Order\Discounts}.
 * @property array|object|null $taxes Tax information, mapped to {@see \MercadoPago\Resources\Order\Tax}.
 *
 * @see \MercadoPago\Client\Order\OrderClient
 */
class Order extends MPResource
{
    use Mapper;

    /** Unique order identifier assigned by MercadoPago. */
    public ?string $id;

    /** Order type (e.g., "online", "offline"). */
    public ?string $type;

    /** Processing mode (e.g., "automatic", "manual", "automatic_async"). */
    public ?string $processing_mode;

    /** Total amount of the order. */
    public ?string $total_amount;

    /** Currency code (ISO 4217, e.g., "BRL", "ARS", "COP"). */
    public ?string $currency;

    /** Merchant's external reference identifier for this order. */
    public ?string $external_reference;

    /** Overall status of the order (e.g., "pending", "processed", "cancelled", "refunded"). */
    public ?string $status;

    /** Detailed status information providing context for the current status. */
    public ?string $status_detail;

    /** Description of the order. */
    public ?string $description;

    /** Capture mode (e.g., "automatic", "manual", "automatic_async"). */
    public ?string $capture_mode;

    /** Marketplace identifier (e.g., "NONE", "MARKETPLACE"). */
    public ?string $marketplace;

    /** Fee charged by the marketplace. */
    public ?string $marketplace_fee;

    /** URL to redirect buyers to complete payment (Checkout PRO). */
    public ?string $checkout_url;

    /** ISO 8601 duration string specifying when the order expires (e.g., "P3D" for 3 days). */
    public ?string $expiration_time;

    /** Timestamp when this order was created (ISO 8601). */
    public ?string $date_created;

    /** Timestamp of the last update to this order (ISO 8601). */
    public ?string $date_last_updated;

    /** Payer information (email, identification, address, etc.). */
    public array|object|null $payer;

    /** Transaction details including payments and refunds. */
    public array|object|null $transactions;

    /** Line items included in this order. */
    public array|object|null $items;

    /** Shipment/delivery information. */
    public array|object|null $shipment;

    /** Additional order configuration (online flow settings, payment method restrictions). */
    public array|object|null $config;

    /** Discount configurations applied to this order. */
    public array|object|null $discounts;

    /** Tax information applied to this order. */
    public array|object|null $taxes;

    /** Additional industry-specific data (travel, platform metadata, etc.). */
    public ?array $additional_info;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "payer" => "MercadoPago\Resources\Order\Payer",
        "transactions" => "MercadoPago\Resources\Order\Transactions",
        "items" => "MercadoPago\Resources\Order\Item",
        "shipment" => "MercadoPago\Resources\Order\Shipment",
        "config" => "MercadoPago\Resources\Order\Config",
        "discounts" => "MercadoPago\Resources\Order\Discounts",
        "taxes" => "MercadoPago\Resources\Order\Tax",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}