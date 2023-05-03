<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

class Payment extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Payment ID. */
    public $id;

    /** Acquirer. */
    public $acquirer;

    /** Acquirer reconciliation. */
    public $acquirer_reconciliation;

    /** Site ID. */
    public $site_id;

    /** Sponsor ID. */
    public $sponsor_id;

    /** Operation type. */
    public $operation_type;

    /** Order ID. */
    public $order_id;

    /** Order. */
    public $order;

    /** Brand ID. */
    public $brand_id;

    /** Build version. */
    public $build_version;

    /** Binary mode. */
    public $binary_mode;

    /** External reference. */
    public $external_reference;

    /** Financing group. */
    public $financing_group;

    /** Extension. */
    public $extension;

    /** Status. */
    public $status;

    /** Status detail. */
    public $status_detail;

    /** Store ID. */
    public $store_id;

    /** Taxes amount. */
    public $taxes_amount;

    /** Payment type. */
    public $payment_type;

    /** Date created. */
    public $date_created;

    /** Last modified. */
    public $last_modified;

    /** Live Mode. */
    public $live_mode;

    /** Last modified date. */
    public $date_last_updated;

    /** Date of expiration. */
    public $date_of_expiration;

    /** Deduction schema. */
    public $deduction_schema;

    /** Approval date. */
    public $date_approved;

    /** Money release date. */
    public $money_release_date;

    /** Money release schema. */
    public $money_release_schema;

    /** Money release status. */
    public $money_release_status;

    /** Currency ID. */
    public $currency_id;

    /** Transaction amount. */
    public $transaction_amount;

    /** Transaction amount refunded. */
    public $transaction_amount_refunded;

    /** Shipping cost. */
    public $shipping_cost;

    /** Total paid amount. */
    public $total_paid_amount;

    /** Finance charge. */
    public $finance_charge;

    /** Net received amount. */
    public $net_received_amount;

    /** Marketplace. */
    public $marketplace;

    /** Marketplace fee. */
    public $marketplace_fee;

    /** Reason. */
    public $reason;

    /** Payer. */
    public $payer;

    /** Collector. */
    public $collector;

    /** Collector ID. */
    public $collector_id;

    /** Counter currency. */
    public $counter_currency;

    /** Payment method ID. */
    public $payment_method_id;

    /** Payment method. */
    public $payment_method;

    /** Payment type ID. */
    public $payment_type_id;

    /** Pos ID. */
    public $pos_id;

    /** Transaction details. */
    public $transaction_details;

    /** Fee details. */
    public $fee_details;

    /** Differential pricing ID. */
    public $differential_pricing_id;

    /** Application fee. */
    public $application_fee;

    /** Authorization code. */
    public $authorization_code;

    /** Capture. */
    public $capture;

    /** Captured. */
    public $captured;

    /** Card. */
    public $card;

    /** Call for authorize ID. */
    public $call_for_authorize_id;

    /** Statement descriptor. */
    public $statement_descriptor;

    /** Shipping amount. */
    public $shipping_amount;

    /** Additional info. */
    public $additional_info;

    /** Campaign ID. */
    public $campaign_id;

    /** Coupon amount. */
    public $coupon_amount;

    /** Installments. */
    public $installments;

    /** Token. */
    public $token;

    /** Description. */
    public $description;

    /** Notification url. */
    public $notification_url;

    /** Issuer ID. */
    public $issuer_id;

    /** Processing mode. */
    public $processing_mode;

    /** Merchant account ID. */
    public $merchant_account_id;

    /** Merchant number. */
    public $merchant_number;

    /** Metadata. */
    public $metadata;

    /** Callback url. */
    public $callback_url;

    /** Amount refunded. */
    public $amount_refunded;

    /** Coupon code. */
    public $coupon_code;

    /** Barcode. */
    public $barcode;

    /** Marketplace owner. */
    public $marketplace_owner;

    /** Integrator ID. */
    public $integrator_id;

    /** Corporation ID. */
    public $corporation_id;

    /** Platform ID. */
    public $platform_id;

    /** Charges details. */
    public $charges_details;

    /** Taxes. */
    public $taxes;

    /** Net amount. */
    public $net_amount;

    /** Point of interaction. */
    public $point_of_interaction;

    /** Payment method option ID. */
    public $payment_method_option_id;

    /** Merchant services. */
    public $merchant_services;
    
    /** Accounts info. */
    public $accounts_info;

    /** Tags. */
    public $tags;

    /** Refunds. */
    public $refunds;

    private $map = [
        "payer" => "MercadoPago\Resources\Payment\Payer",
        "fee_details" => "MercadoPago\Resources\Payment\FeeDetails",
        "additional_info" => "MercadoPago\Resources\Payment\AdditionalInfo",
        "transaction_details" => "MercadoPago\Resources\Payment\TransactionDetails",
        "card" => "MercadoPago\Resources\Payment\PaymentCard",
        "point_of_interaction" => "MercadoPago\Resources\Payment\PointOfInteraction",
        "payment_method" => "MercadoPago\Resources\Payment\PaymentMethod"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
