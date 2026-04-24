<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents a MercadoPago Order resource.
 *
 * An order is the top-level entity that groups items, payer information,
 * transactions (payments, refunds, chargebacks), shipping details, and
 * configuration for a purchase flow in the MercadoPago Orders API.
 *
 * @see \MercadoPago\Client\Order\OrderClient
 */
class Order extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Unique identifier of the order assigned by MercadoPago. */
    public ?string $id;

    /** Order type (e.g., "online" for e-commerce transactions). */
    public ?string $type;

    /** Seller-defined reference to correlate the order with an external system. */
    public ?string $external_reference;

    /** ISO 3166-1 alpha-2 country code where the order is processed. */
    public ?string $country_code;

    /** Current high-level status of the order (e.g., "opened", "closed", "expired"). */
    public ?string $status;

    /** Granular detail complementing the order status. */
    public ?string $status_detail;

    /** Determines how funds are captured (e.g., "automatic" or "manual"). */
    public ?string $capture_mode;

    /** MercadoPago user ID of the seller who owns the order. */
    public ?string $user_id;

    /** Temporary token identifying the client session for the checkout. */
    public ?string $client_token;

    /** Total amount of the order before any discounts or fees. */
    public ?string $total_amount;

    /** Total amount effectively paid by the buyer. */
    public ?string $total_paid_amount;

    /** Processing mode for payments (e.g., "aggregator", "gateway"). */
    public ?string $processing_mode;

    /** Short description of the order shown to the buyer. */
    public ?string $description;

    /** Marketplace identifier when the order is placed through a marketplace. */
    public ?string $marketplace;

    /** Fee charged by the marketplace on this order. */
    public ?string $marketplace_fee;

    /** ISO 8601 timestamp when the order was created. */
    public ?string $created_date;

    /** ISO 8601 timestamp of the last update to the order. */
    public ?string $last_updated_date;

    /** ISO 8601 timestamp indicating when the checkout becomes available. */
    public ?string $checkout_available_at;

    /** ISO 8601 duration or timestamp after which the order expires. */
    public ?string $expiration_time;

    /** Integration metadata linking the order to a platform, integrator, or sponsor. Maps to {@see IntegrationData}. */
    public array|object|null $integration_data;

    /** Buyer information associated with this order. Maps to {@see Payer}. */
    public array|object|null $payer;

    /** Transaction container holding payments, refunds, and chargebacks. Maps to {@see Transactions}. */
    public array|object|null $transactions;

    /** Line items included in the order. Each element maps to {@see Items}. */
    public ?array $items;

    /** Order-level configuration for payment methods and online checkout. Maps to {@see Config}. */
    public array|object|null $config;

    /** Arbitrary key-value pairs with additional context about the order. */
    public ?array $additional_info;

    /** Shipping details and delivery address for the order. Maps to {@see Shipment}. */
    public array|object|null $shipment;

    /** ISO 4217 currency code for the order amounts (e.g., "BRL", "ARS"). */
    public ?string $currency;

    /** Discount rules applied to the order by payment method. Maps to {@see Discounts}. */
    public array|object|null $discounts;

    /** Tax entries applied to the order. Each element maps to {@see Taxes}. */
    public ?array $taxes;

    /** Type-specific response data (e.g., QR code for QR-based orders). Maps to {@see TypeResponse}. */
    public array|object|null $type_response;

    private $map = [
        "transactions" => "MercadoPago\Resources\Order\Transactions",
        "items" => "MercadoPago\Resources\Order\Items",
        "integration_data" => "MercadoPago\Resources\Order\IntegrationData",
        "payer" => "MercadoPago\Resources\Order\Payer",
        "config" => "MercadoPago\Resources\Order\Config",
        "shipment" => "MercadoPago\Resources\Order\Shipment",
        "discounts" => "MercadoPago\Resources\Order\Discounts",
        "taxes" => "MercadoPago\Resources\Order\Taxes",
        "type_response" => "MercadoPago\Resources\Order\TypeResponse",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
