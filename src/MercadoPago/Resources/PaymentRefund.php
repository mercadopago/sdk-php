<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Payment Refund class. */
class PaymentRefund extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Refund id. */
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
    public object|array|null $source;

    /** Amount refunded to the payer. */
    public ?int $amount_refunded_to_payer;

    /** Partition details. */
    public object|array|null $partition_details;

    /** Labels. */
    public object|array|null $labels;

    /** Additional data. */
    public object|array|null $additional_data;

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
