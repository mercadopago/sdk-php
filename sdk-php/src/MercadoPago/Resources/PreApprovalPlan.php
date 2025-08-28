<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** PreApprovalPlan class. */
class PreApprovalPlan extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Subscription ID. */
    public ?string $id;

    /** Return URL. */
    public ?string $back_url;

    /** Collector ID. */
    public ?int $collector_id;

    /** Application ID. */
    public ?int $application_id;

    /** Reason for the subscription. */
    public ?string $reason;

    /** Subscription status. */
    public ?string $status;

    /** Date of creation. */
    public ?string $date_created;

    /** Date of last modification. */
    public ?string $last_modified;

    /** Initial point. */
    public ?string $init_point;

    /** Auto-recurring subscription details. */
    public ?object $auto_recurring;

    /** Allowed payment methods. */
    public array|object|null $payment_methods_allowed;


    public $map = [
        "auto_recurring" => "MercadoPago\Resources\PreApprovalPlan\AutoRecurring",
        "payment_methods_allowed" => "MercadoPago\Resources\PreApprovalPlan\PaymentMethodsAllowed",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
