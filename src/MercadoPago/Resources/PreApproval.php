<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** PreApproval class. */
class PreApproval extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Preapproval ID. */
    public ?string $id;

    /** Payer ID. */
    public ?int $payer_id;

    /** Payer email. */
    public ?string $payer_email;

    /** Return URL. */
    public ?string $back_url;

    /** Seller ID. */
    public ?int $collector_id;

    /** Application ID. */
    public ?int $application_id;

    /** Preapproval status. */
    public ?string $status;

    /** Reason for the subscription. */
    public ?string $reason;

    /** Preapproval reference value. */
    public ?string $external_reference;

    /** Creation date. */
    public ?string $date_created;

    /** Last modified date. */
    public ?string $last_modified;

    /** The subscription's starting point. */
    public ?string $init_point;

    /** The pre-approval plan ID. */
    public ?string $preapproval_plan_id;

    /** The details of auto-recurring. */
    public array|object|null $auto_recurring;

    /** The summarized subscription details. */
    public array|object|null $summarized;

    /** The next payment date. */
    public ?string $next_payment_date;

    /** The payment method ID. */
    public ?string $payment_method_id;

    /** The credit card ID. */
    public ?string $card_id;

    /** First invoice offset. */
    public $first_invoice_offset;

    public $map = [
        "auto_recurring" => "MercadoPago\Resources\PreApproval\AutoRecurring",
        "summarized" => "MercadoPago\Resources\PreApproval\Summarized",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
