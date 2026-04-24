<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a single refund entry within a list of refunds for a payment.
 *
 * Mirrors the structure of {@see \MercadoPago\Resources\PaymentRefund} but is used
 * as an element in the array returned by
 * {@see \MercadoPago\Client\Payment\PaymentRefundClient::list()}.
 */
class PaymentRefundListResult
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Unique refund identifier assigned by MercadoPago. */
    public ?int $id;

    /** Identifier of the original payment that was refunded. */
    public ?int $payment_id;

    /** Amount refunded (may be partial or the full transaction amount). */
    public ?float $amount;

    /** Adjustment applied to the refund amount (e.g. currency conversion differences). */
    public ?float $adjustment_amount;

    /** Current refund status (e.g. "approved", "in_process"). */
    public ?string $status;

    /** How the refund was processed (e.g. "standard"). */
    public ?string $refund_mode;

    /** ISO 8601 timestamp when the refund was created. */
    public ?string $date_created;

    /** Reason provided for issuing the refund. */
    public ?string $reason;

    /** Unique sequence number for reconciliation with financial systems. */
    public ?string $unique_sequence_number;

    /** @var \MercadoPago\Resources\Common\Source|array|null Actor or system that initiated the refund. */
    public array|object|null $source;

    /** Net amount returned to the payer's payment method. */
    public ?int $amount_refunded_to_payer;

    /** Breakdown details when the refund is split across multiple destinations. */
    public array|object|null $partition_details;

    /** Classification labels attached to the refund by MercadoPago. */
    public array|object|null $labels;

    /** Additional contextual data associated with the refund. */
    public array|object|null $additional_data;

    /** ISO 8601 date when the refund expires if not yet processed. */
    public ?string $expiration_date;

    public $map = [
        "source" => "MercadoPago\Resources\Common\Source"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
