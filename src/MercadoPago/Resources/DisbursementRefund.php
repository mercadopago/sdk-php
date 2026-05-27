<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/**
 * Disbursement Refund resource.
 *
 * Represents a refund on a disbursement within an advanced (split) payment.
 *
 * @see \MercadoPago\Client\DisbursementRefund\DisbursementRefundClient
 */
class DisbursementRefund extends MPResource
{
    /** The disbursement refund ID. */
    public ?int $id;

    /** The advanced payment ID this refund belongs to. */
    public ?int $advanced_payment_id;

    /** The disbursement ID that was refunded. */
    public ?int $disbursement_id;

    /** The refunded amount. */
    public ?float $amount;

    /** The current status of the refund. */
    public ?string $status;

    /** The date and time when the refund was created. */
    public ?string $date_created;
}
