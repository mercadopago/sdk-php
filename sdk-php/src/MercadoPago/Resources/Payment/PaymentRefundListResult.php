<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Payment PaymentRefundListResult class. */
class PaymentRefundListResult
{
    /** Class mapper. */
    use Mapper;

    /** Refund ID. */
    public ?int $id;

    /** ID of the refunded payment. */
    public ?int $payment_id;

    /** Amount refunded. */
    public ?float $amount;

    /** Adjustment amount. */
    public ?float $adjustment_amount;

    /** Refund status. */
    public ?string $status;

    /** Refund mode. */
    public ?string $refund_mode;

    /** Date of creation. */
    public ?string $date_created;

    /** Refund reason. */
    public ?string $reason;

    /** Unique sequence number. */
    public ?string $unique_sequence_number;

    /** Source of the refund. */
    public array|object|null $source;

    /** Amount refunded to the payer. */
    public ?int $amount_refunded_to_payer;

    /** Partition details. */
    public array|object|null $partition_details;

    /** Labels. */
    public array|object|null $labels;

    /** Additional data. */
    public array|object|null $additional_data;

    /** Expiration date. */
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
