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

    /** Preapproval title. */
    public ?string $reason;

    /** Preapproval reference value. */
    public ?string $external_reference;

    /** Date of the next payment debit. */
    public ?string $next_payment_date;

    /** Creation date. */
    public ?string $date_created;

    /** Last modified date. */
    public ?string $last_modified;

    /** Preapproval checkout link. */
    public ?string $init_point;

    /** Preapproval sandbox checkout link. */
    public ?string $sandbox_init_point;

    /** Payment method ID. */
    public ?string $payment_method_id;

    /** Recurring data. */
    public array|object|null $auto_recurring;

    /** Version. */
    public ?int $version;

    /** First invoice offset. */
    public $first_invoice_offset;

    public $map = [
        "auto_recurring" => "MercadoPago\Resources\PreApproval\AutoRecurring",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
