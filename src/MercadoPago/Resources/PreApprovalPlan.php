<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * PreApproval Plan (Subscription Plan) resource.
 *
 * Represents a subscription plan template in MercadoPago. A plan defines the recurring
 * billing rules (frequency, amount, currency) and allowed payment methods that
 * subscribers will follow when they create a subscription from this plan.
 *
 * @property object|null $auto_recurring Recurring billing config, mapped to {@see \MercadoPago\Resources\PreApprovalPlan\AutoRecurring}.
 * @property array|object|null $payment_methods_allowed Allowed payment methods, mapped to {@see \MercadoPago\Resources\PreApprovalPlan\PaymentMethodsAllowed}.
 *
 * @see \MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient
 */
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
