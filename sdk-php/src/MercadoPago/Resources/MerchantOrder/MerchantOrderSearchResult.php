<?php

namespace MercadoPago\Resources\MerchantOrder;

use MercadoPago\Serialization\Mapper;

/** Merchant Order Search Result class. */
class MerchantOrderSearchResult
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
