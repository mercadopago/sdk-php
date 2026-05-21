<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Merchant Order resource.
 *
 * Represents a merchant order in the MercadoPago platform, which groups one or more payments
 * associated with a checkout preference. A merchant order tracks the lifecycle of a purchase
 * including its items, payments, shipments, and overall fulfillment status.
 *
 * @property int|null $id Order ID.
 * @property string|null $preference_id Payment preference identifier associated to the merchant order.
 * @property string|null $status Current merchant order state (e.g. "opened", "closed").
 * @property array|object|null $payer Buyer information, mapped to {@see \MercadoPago\Resources\MerchantOrder\Payer}.
 * @property array|object|null $collector Seller information, mapped to {@see \MercadoPago\Resources\MerchantOrder\Collector}.
 * @property array|null $payments Payments associated with this order, mapped to {@see \MercadoPago\Resources\MerchantOrder\Payment}.
 * @property array|null $items Items included in this order, mapped to {@see \MercadoPago\Resources\MerchantOrder\Item}.
 * @property array|null $shipments Shipments for this order, mapped to {@see \MercadoPago\Resources\MerchantOrder\Shipment}.
 *
 * @see \MercadoPago\Client\MerchantOrder\MerchantOrderClient
 */
class MerchantOrder extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Order ID. */
    public ?int $id;

    /** Payment preference identifier associated to the merchant order. */
    public ?string $preference_id;

    /** Application ID. */
    public ?string $application_id;

    /** Show the current merchant order state. */
    public ?string $status;

    /** Country identifier that merchant order belongs to. */
    public ?string $site_id;

    /** Payer information. */
    public array|object|null $payer;

    /** Seller information. */
    public array|object|null $collector;

    /** Sponsor ID. */
    public ?string $sponsor_id;

    /** Amount paid in this order. */
    public ?float $paid_amount;

    /** Amount refunded in this Order. */
    public ?float $refunded_amount;

    /** Shipping fee. */
    public ?float $shipping_cost;

    /** Date of creation. */
    public ?string $date_created;

    /** Last modified date. */
    public ?string $last_updated;

    /** If the Order is expired (true) or not (false). */
    public ?bool $cancelled;

    /** Payments information. */
    public ?array $payments;

    /** Items information. */
    public ?array $items;

    /** Shipments information. */
    public ?array $shipments;

    /** URL where you'd like to receive a payment notification. */
    public ?string $notification_url;

    /** Additional information. */
    public ?string $additional_info;

    /** Reference you can synchronize with your payment system. */
    public ?string $external_reference;

    /** Origin of the payment. */
    public ?string $marketplace;

    /** Total amount of the order. */
    public ?float $total_amount;

    /** Current merchant order status given the payments status. */
    public ?string $order_status;

    /** If is test. */
    public ?bool $is_test;

    /** Payouts. */
    public array|object|null $payouts;

    private $map = [
        "payer" => "MercadoPago\Resources\MerchantOrder\Payer",
        "collector" => "MercadoPago\Resources\MerchantOrder\Collector",
        "payments" => "MercadoPago\Resources\MerchantOrder\Payment",
        "items" => "MercadoPago\Resources\MerchantOrder\Item",
        "shipments" => "MercadoPago\Resources\MerchantOrder\Shipment",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
