<?php

namespace MercadoPago\Resources\MerchantOrder;

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

    /** Gives more detailed information on the current state or rejection cause. */
    public ?string $status_details;

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
