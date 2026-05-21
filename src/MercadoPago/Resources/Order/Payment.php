<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents an individual payment within a MercadoPago order transaction.
 *
 * An order may contain one or more payments (e.g., split payments). Each payment
 * tracks its own amount, status, payment method, retry attempts, and refund totals.
 *
 * @see \MercadoPago\Resources\Order\Transactions
 * @see \MercadoPago\Client\Order\OrderTransactionClient
 */
class Payment
{
    /** Class mapper. */
    use Mapper;

    /** Unique identifier of this payment assigned by MercadoPago. */
    public ?string $id;

    /** Seller-defined reference to correlate this payment with an external system. */
    public ?string $reference_id;

    /** Current payment status (e.g., "approved", "pending", "rejected"). */
    public ?string $status;

    /** Granular detail complementing the payment status (e.g., "accredited", "pending_waiting_transfer"). */
    public ?string $status_detail;

    /** Requested payment amount in the order's currency. */
    public ?string $amount;

    /** Amount effectively collected from the buyer. */
    public ?string $paid_amount;

    /** ISO 8601 timestamp after which the payment can no longer be completed. */
    public ?string $date_of_expiration;

    /** Duration or timestamp defining how long the payment remains valid. */
    public ?string $expiration_time;

    /** Current retry attempt number for this payment. */
    public ?int $attempt_number;

    /** History of payment attempts. Each element maps to {@see Attempt}. */
    public ?array $attempts;

    /** Payment method used for this payment (card, Pix, boleto, etc.). Maps to {@see PaymentMethod}. */
    public array|object|null $payment_method;

    /** Automatic/recurring payment configuration. Maps to {@see AutomaticPayments}. */
    public array|object|null $automatic_payments;

    /** Stored credential data for card-on-file or recurring transactions. Maps to {@see StoredCredential}. */
    public array|object|null $stored_credential;

    /** Subscription billing data when this payment is part of a recurring plan. Maps to {@see SubscriptionData}. */
    public array|object|null $subscription_data;

    /** Total amount that has been refunded for this payment. */
    public ?string $refunded_amount;

    /** Payment provider or acquirer processing this payment. */
    public ?string $provider;

    /** Discounts applied to this specific payment. Each element maps to {@see PaymentDiscount}. */
    public ?array $discounts;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethod",
        "attempts" => "MercadoPago\Resources\Order\Attempt",
        "automatic_payments" => "MercadoPago\Resources\Order\AutomaticPayments",
        "stored_credential" => "MercadoPago\Resources\Order\StoredCredential",
        "subscription_data" => "MercadoPago\Resources\Order\SubscriptionData",
        "discounts" => "MercadoPago\Resources\Order\PaymentDiscount",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
