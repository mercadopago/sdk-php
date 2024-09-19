<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Payment class. */
class Payment extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Payment ID. */
    public ?int $id;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /** Payment type ID. */
    public ?string $payment_type_id;

    /** Date created. */
    public ?string $date_created;

    /** Approval date. */
    public ?string $date_approved;

    /** Last modified date. */
    public ?string $date_last_updated;

    /** Currency ID. */
    public ?string $currency_id;

    /** Description. */
    public ?string $description;

    /** Collector ID. */
    public ?int $collector_id;

    /** Payer. */
    public array|object|null $payer;

    /** Transaction amount. */
    public ?float $transaction_amount;

    /** Transaction details. */
    public array|object|null $transaction_details;

    /** Installments. */
    public ?int $installments;

    /** Acquirer. */
    public ?array $acquirer;

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

    /** Store ID. */
    public ?string $store_id;

    /** Taxes amount. */
    public ?int $taxes_amount;

    /** Live Mode. */
    public ?bool $live_mode;

    /** Date of expiration. */
    public ?string $date_of_expiration;

    /** Deduction schema. */
    public ?string $deduction_schema;

    /** Money release date. */
    public ?string $money_release_date;

    /** Money release schema. */
    public ?string $money_release_schema;

    /** Money release status. */
    public ?string $money_release_status;

    /** Transaction amount refunded. */
    public ?float $transaction_amount_refunded;

    /** ForwardData. */
    public array|object|null $forward_data;

    /** Counter currency. */
    public ?string $counter_currency;

    /** Payment method ID. */
    public ?string $payment_method_id;

    /** Payment method. */
    public array|object|null $payment_method;

    /** Pos ID. */
    public ?string $pos_id;

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

    /** Token. */
    public ?string $token;

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

    /** Barcode info. */
    public array|object|null $barcode;

    private $map = [
        "forward_data" => "MercadoPago\Resources\Payment\ForwardData",
        "payer" => "MercadoPago\Resources\Payment\Payer",
        "fee_details" => "MercadoPago\Resources\Payment\FeeDetails",
        "additional_info" => "MercadoPago\Resources\Payment\AdditionalInfo",
        "transaction_details" => "MercadoPago\Resources\Payment\TransactionDetails",
        "card" => "MercadoPago\Resources\Payment\Card",
        "point_of_interaction" => "MercadoPago\Resources\Payment\PointOfInteraction",
        "payment_method" => "MercadoPago\Resources\Payment\PaymentMethod",
        "metadata" => "MercadoPago\Resources\Payment\Metadata",
        "three_ds_info" => "MercadoPago\Resources\Payment\ThreeDSInfo",
        "barcode" => "MercadoPago\Resources\Payment\Barcode",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
