<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Payment resource.
 *
 * Represents a payment associated with a merchant order. A merchant order may have
 * multiple payments (e.g. split payments, retries). Each payment tracks its own
 * amount, status, approval date, and refund information.
 */
class Payment
{
    /** Payment ID. */
    public ?int $id;

    /** Product cost. */
    public ?float $transaction_amount;

    /** Total amount paid. */
    public ?float $total_paid_amount;

    /** Shipping fee. */
    public ?float $shipping_cost;

    /** ID of the currency used in payment. */
    public ?string $currency_id;

    /** Payment status. */
    public ?string $status;

    /** @deprecated deprecated since SDK version 3.0.4. */
    public ?string $status_details;

    /** Gives more detailed information on the current state or rejection cause. */
    public ?string $status_detail;

    /** Operation type. */
    public ?string $operation_type;

    /** Approval date. */
    public ?string $date_approved;

    /** Date of creation. */
    public ?string $date_created;

    /** Last modified date. */
    public ?string $last_modified;

    /** Amount refunded in this payment. */
    public ?float $amount_refunded;
}
