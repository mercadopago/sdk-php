<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** PaymentSearchResult class. */
class PaymentSearchResult
{
    /** Class mapper. */
    use Mapper;

    /** Payment ID. */
    public ?int $id;

    /** Acquirer reconciliation. */
    public ?array $acquirer_reconciliation;

    /** Site ID. */
    public ?string $site_id;

    /** Sponsor ID. */
    public ?int $sponsor_id;

    /** Operation type. */
    public ?string $operation_type;

    /** Order ID. */
    public ?int $order_id;

    /** Order. */
    public ?array $order;

    /** Brand ID. */
    public ?string $brand_id;

    /** Build version. */
    public ?string $build_version;

    /** Binary mode. */
    public ?bool $binary_mode;

    /** External reference. */
    public ?string $external_reference;

    /** Financing group. */
    public ?string $financing_group;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /** Store ID. */
    public ?string $store_id;

    /** Taxes amount. */
    public ?int $taxes_amount;

    /** Date created. */
    public ?string $date_created;

    /** Live Mode. */
    public ?bool $live_mode;

    /** Last modified date. */
    public ?string $date_last_updated;

    /** Date of expiration. */
    public ?string $date_of_expiration;

    /** Deduction schema. */
    public ?string $deduction_schema;

    /** Approval date. */
    public ?string $date_approved;

    /** Money release date. */
    public ?string $money_release_date;

    /** Money release schema. */
    public ?string $money_release_schema;

    /** Money release status. */
    public ?string $money_release_status;

    /** Currency ID. */
    public ?string $currency_id;

    /** Transaction amount. */
    public ?float $transaction_amount;

    /** Transaction amount refunded. */
    public ?float $transaction_amount_refunded;

    /** Payer. */
    public array|object|null $payer;

    /** Collector ID. */
    public ?int $collector_id;

    /** Counter currency. */
    public ?string $counter_currency;

    /** Payment method ID. */
    public ?string $payment_method_id;

    /** Payment method. */
    public array|object|null $payment_method;

    /** Payment type ID. */
    public ?string $payment_type_id;

    /** Pos ID. */
    public ?string $pos_id;

    /** Transaction details. */
    public array|object|null $transaction_details;

    /** Fee details. */
    public ?array $fee_details;

    /** Differential pricing ID. */
    public ?string $differential_pricing_id;

    /** Application fee. */
    public ?float $application_fee;

    /** Authorization code. */
    public ?string $authorization_code;

    /** Captured. */
    public ?bool $captured;

    /** Card. */
    public array|object|null $card;

    /** Call for authorize ID. */
    public ?string $call_for_authorize_id;

    /** Statement descriptor. */
    public ?string $statement_descriptor;

    /** Shipping amount. */
    public ?float $shipping_amount;

    /** Additional info. */
    public array|object|null $additional_info;

    /** Coupon amount. */
    public ?float $coupon_amount;

    /** Installments. */
    public ?int $installments;

    /** Token. */
    public ?string $token;

    /** Description. */
    public ?string $description;

    /** Notification url. */
    public ?string $notification_url;

    /** Issuer ID. */
    public ?string $issuer_id;

    /** Processing mode. */
    public ?string $processing_mode;

    /** Merchant account ID. */
    public ?string $merchant_account_id;

    /** Merchant number. */
    public ?string $merchant_number;

    /** Metadata. */
    public array|object|null $metadata;

    /** Callback url. */
    public ?string $callback_url;

    /** Coupon code. */
    public ?string $coupon_code;

    /** Marketplace owner. */
    public ?string $marketplace_owner;

    /** Integrator ID. */
    public ?string $integrator_id;

    /** Corporation ID. */
    public ?string $corporation_id;

    /** Platform ID. */
    public ?string $platform_id;

    /** Charges details. */
    public ?array $charges_details;

    /** Taxes. */
    public ?array $taxes;

    /** Net amount. */
    public ?float $net_amount;

    /** Point of interaction. */
    public array|object|null $point_of_interaction;

    /** Accounts info. */
    public array|object|null $accounts_info;

    /** Tags. */
    public array|object|null $tags;

    /** Refunds. */
    public ?array $refunds;

    /** 3DS info. */
    public array|object|null $three_ds_info;

    /** Shipping cost. */
    public ?int $shipping_cost;

    private $map = [
        "payer" => "MercadoPago\Resources\Payment\Payer",
        "fee_details" => "MercadoPago\Resources\Payment\FeeDetails",
        "additional_info" => "MercadoPago\Resources\Payment\AdditionalInfo",
        "transaction_details" => "MercadoPago\Resources\Payment\TransactionDetails",
        "card" => "MercadoPago\Resources\Payment\Card",
        "point_of_interaction" => "MercadoPago\Resources\Payment\PointOfInteraction",
        "payment_method" => "MercadoPago\Resources\Payment\PaymentMethod",
        "metadata" => "MercadoPago\Resources\Payment\Metadata",
        "three_ds_info" => "MercadoPago\Resources\Payment\ThreeDSInfo",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
