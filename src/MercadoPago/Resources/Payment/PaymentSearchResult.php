<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a single payment entry within a search result set from the MercadoPago API.
 *
 * Contains the same payment fields as {@see \MercadoPago\Resources\Payment} but is used
 * as an element in the results array of {@see \MercadoPago\Resources\PaymentSearch}.
 * Returned by {@see \MercadoPago\Client\Payment\PaymentClient::search()}.
 */
class PaymentSearchResult
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Unique payment identifier assigned by MercadoPago. */
    public ?int $id;

    /** Acquirer reconciliation data for matching with bank/acquirer records. */
    public ?array $acquirer_reconciliation;

    /** MercadoPago site/country identifier (e.g. "MLA", "MLB", "MLM"). */
    public ?string $site_id;

    /** Identifier of the sponsor in a marketplace or platform integration. */
    public ?int $sponsor_id;

    /** Type of operation (e.g. "regular_payment", "money_transfer"). */
    public ?string $operation_type;

    /** Identifier of the associated order (legacy field). */
    public ?int $order_id;

    /** Associated order data. */
    public ?array $order;

    /** Brand identifier for white-label integrations. */
    public ?string $brand_id;

    /** SDK or API build version used to create the payment. */
    public ?string $build_version;

    /** When true, the payment can only result in "approved" or "rejected" (no "in_process"). */
    public ?bool $binary_mode;

    /** External reference ID set by the integrator for reconciliation. */
    public ?string $external_reference;

    /** Financing group identifier for grouped installment plans. */
    public ?string $financing_group;

    /** Current payment status (e.g. "approved", "rejected", "pending", "in_process"). */
    public ?string $status;

    /** Detailed reason for the current status (e.g. "accredited", "cc_rejected_other_reason"). */
    public ?string $status_detail;

    /** Identifier of the physical store where the payment originated. */
    public ?string $store_id;

    /** Total tax amount included in the payment. */
    public ?int $taxes_amount;

    /** ISO 8601 timestamp when the payment was created. */
    public ?string $date_created;

    /** Whether the payment was created in production (true) or sandbox (false). */
    public ?bool $live_mode;

    /** ISO 8601 timestamp of the last update to the payment. */
    public ?string $date_last_updated;

    /** ISO 8601 timestamp when the payment expires (for pending payments). */
    public ?string $date_of_expiration;

    /** Schema that defines how deductions are applied. */
    public ?string $deduction_schema;

    /** ISO 8601 timestamp when the payment was approved. */
    public ?string $date_approved;

    /** ISO 8601 date when the funds will be released to the seller. */
    public ?string $money_release_date;

    /** Schema that defines the money release schedule. */
    public ?string $money_release_schema;

    /** Current status of the money release process. */
    public ?string $money_release_status;

    /** ISO 4217 currency code (e.g. "ARS", "BRL", "MXN"). */
    public ?string $currency_id;

    /** Total amount charged to the payer. */
    public ?float $transaction_amount;

    /** Cumulative amount that has been refunded for this payment. */
    public ?float $transaction_amount_refunded;

    /** @var Payer|array|null Payer (buyer) information. */
    public array|object|null $payer;

    /** MercadoPago user ID of the payment collector (seller). */
    public ?int $collector_id;

    /** Counter-currency identifier for cross-border payments. */
    public ?string $counter_currency;

    /** Identifier of the payment method used (e.g. "visa", "pix", "bolbradesco"). */
    public ?string $payment_method_id;

    /** @var PaymentMethod|array|null Detailed payment method information. */
    public array|object|null $payment_method;

    /** Payment method type (e.g. "credit_card", "debit_card", "ticket", "bank_transfer"). */
    public ?string $payment_type_id;

    /** Identifier of the Point of Sale device, if applicable. */
    public ?string $pos_id;

    /** @var TransactionDetails|array|null Financial details of the transaction. */
    public array|object|null $transaction_details;

    /** @var FeeDetails[]|null List of fees applied to the payment. */
    public ?array $fee_details;

    /** Identifier of the differential pricing plan applied. */
    public ?string $differential_pricing_id;

    /** Fee charged by the marketplace to the seller on this payment. */
    public ?float $application_fee;

    /** Authorization code returned by the card issuer. */
    public ?string $authorization_code;

    /** Whether the payment amount has been captured (relevant for two-step payments). */
    public ?bool $captured;

    /** @var Card|array|null Card details used in the payment. */
    public array|object|null $card;

    /** Identifier for call-for-authorize flows when the issuer requires phone confirmation. */
    public ?string $call_for_authorize_id;

    /** Text that appears on the payer's card statement. */
    public ?string $statement_descriptor;

    /** Shipping cost amount included in the payment. */
    public ?float $shipping_amount;

    /** @var AdditionalInfo|array|null Additional information about items, payer, and shipment. */
    public array|object|null $additional_info;

    /** Discount coupon amount applied to the payment. */
    public ?float $coupon_amount;

    /** Number of installments chosen by the payer. */
    public ?int $installments;

    /** Card token generated by MercadoPago.js for secure card data handling. */
    public ?string $token;

    /** Short description of the payment purpose shown to the payer. */
    public ?string $description;

    /** URL where MercadoPago sends webhook notifications for status changes. */
    public ?string $notification_url;

    /** Identifier of the card issuer. */
    public ?string $issuer_id;

    /** Processing mode for the payment (e.g. "aggregator", "gateway"). */
    public ?string $processing_mode;

    /** Merchant account identifier for gateway mode processing. */
    public ?string $merchant_account_id;

    /** Merchant number assigned by the acquirer. */
    public ?string $merchant_number;

    /** @var Metadata|array|null Custom key-value metadata attached to the payment. */
    public array|object|null $metadata;

    /** URL to redirect the payer after a payment attempt. */
    public ?string $callback_url;

    /** Coupon code applied by the payer at checkout. */
    public ?string $coupon_code;

    /** Marketplace owner identifier. */
    public ?string $marketplace_owner;

    /** Integrator identifier for tracking third-party platform integrations. */
    public ?string $integrator_id;

    /** Corporation identifier for enterprise-level tracking. */
    public ?string $corporation_id;

    /** Platform identifier for multi-platform tracking. */
    public ?string $platform_id;

    /** Breakdown of charges applied to the payment. */
    public ?array $charges_details;

    /** Tax details applied to the payment. */
    public ?array $taxes;

    /** Net amount received by the seller after fees. */
    public ?float $net_amount;

    /** @var PointOfInteraction|array|null Information about where the payment interaction occurred (e.g. QR, deep link). */
    public array|object|null $point_of_interaction;

    /** Account-level information related to the transaction. */
    public array|object|null $accounts_info;

    /** Internal tags associated with the payment. */
    public array|object|null $tags;

    /** List of refunds applied to this payment. */
    public ?array $refunds;

    /** @var ThreeDSInfo|array|null 3D Secure authentication information. */
    public array|object|null $three_ds_info;

    /** Total shipping cost for the order. */
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
