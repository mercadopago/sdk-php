<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Preference class. */
class Preference extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Preference ID. */
    public ?string $id;

    /** List of items to be paid. */
    public ?array $items;

    /** Payer information. */
    public array|object|null $payer;

    /** Client ID. */
    public ?string $client_id;

    /** Set up payment methods. */
    public array|object|null $payment_methods;

    /** URLs to return to the sellers website. */
    public array|object|null $back_urls;

    /** URLs to redirect to the sellers website. */
    public array|object|null $redirect_urls;

    /** Shipments information. */
    public array|object|null $shipments;

    /** URL where you'd like to receive a payment notification. */
    public ?string $notification_url;

    /** How the payment will be specified in the card bill. */
    public ?string $statement_descriptor;

    /** Reference you can synchronize with your payment system. */
    public ?string $external_reference;

    /** True if a preference expires, false if not. */
    public ?bool $expires;

    /** Expiration date of cash payment. */
    public ?string $date_of_expiration;

    /** Date when the preference will be active. */
    public ?string $expiration_date_from;

    /** Date when the preference will be expired. */
    public ?string $expiration_date_to;

    /** Collector ID. */
    public ?int $collector_id;

    /** Origin of the payment. Default value: NONE. */
    public ?string $marketplace;

    /** Marketplace's fee charged by application owner. */
    public ?float $marketplace_fee;

    /** Additional info. */
    public ?string $additional_info;

    /**
     * If specified, your buyers will be redirected back to your site immediately after completing the
     * purchase.
     */
    public ?string $auto_return;

    /** Operation type. */
    public ?string $operation_type;

    /** Differential pricing configuration for this preference. */
    public array|object|null $differential_pricing;

    /** Configures which processing modes to use. */
    public ?array $processing_modes;

    /**
     * When set to true, the payment can only be approved or rejected. Otherwise in_process status is
     * added.
     */
    public ?bool $binary_mode;

    /** Taxes for preferences. */
    public ?array $taxes;

    /** Tracks to be executed during the users interaction in the Checkout flow. */
    public ?array $tracks;

    /**
     * Data that can be attached to the preference to record additional attributes of the merchant.
     */
    public ?array $metadata;

    /** Checkout URL from preference. */
    public ?string $init_point;

    /** Sandbox checkout URL from preference. */
    public ?string $sandbox_init_point;

    /** Date of creation. */
    public ?string $date_created;

    /** Coupon code. */
    public ?string $coupon_code;

    /** Coupon labels. */
    public ?array $coupon_labels;

    /** internal metadata. */
    public ?array $internal_metadata;

    /** Site ID. */
    public ?string $site_id;

    /** Product ID. */
    public ?string $product_id;

    /** Live mode. */
    public ?bool $live_mode;

    /** Last modified. */
    public ?string $last_updated;

    /** Purpose. */
    public ?string $purpose;

    /** Total amount. */
    public ?int $total_amount;

    /** Headers. */
    public $headers;

    /** Created source. */
    public $created_source;

    /** Created by app. */
    public $created_by_app;

    public $map = [
        "items" => "MercadoPago\Resources\Preference\Item",
        "payer" => "MercadoPago\Resources\Preference\Payer",
        "payment_methods" => "MercadoPago\Resources\Preference\PaymentMethods",
        "back_urls" => "MercadoPago\Resources\Preference\BackUrls",
        "redirect_urls" => "MercadoPago\Resources\Preference\RedirectUrls",
        "shipments" => "MercadoPago\Resources\Preference\Shipments",
        "differential_pricing" => "MercadoPago\Resources\Common\DifferentialPricing",
        "taxes" => "MercadoPago\Resources\Preference\Tax",
        "tracks" => "MercadoPago\Resources\Preference\Tracks",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
