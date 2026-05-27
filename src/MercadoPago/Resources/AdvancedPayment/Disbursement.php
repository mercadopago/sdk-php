<?php

namespace MercadoPago\Resources\AdvancedPayment;

use MercadoPago\Net\MPResource;

/**
 * Disbursement sub-resource within an Advanced Payment.
 *
 * Represents a single receiver (collector) that receives funds
 * when an advanced (split) payment is captured.
 */
class Disbursement extends MPResource
{
    /** The disbursement ID. */
    public ?int $id;

    /** The collector (receiver) ID. */
    public ?int $collector_id;

    /** The amount to disburse to this collector. */
    public ?float $amount;

    /** The external reference for this disbursement. */
    public ?string $external_reference;

    /** The application fee retained by the marketplace. */
    public ?float $application_fee;

    /** The money release date for this disbursement. */
    public ?string $money_release_date;

    /** The status of the disbursement. */
    public ?string $status;

    /** The status detail. */
    public ?string $status_detail;
}
