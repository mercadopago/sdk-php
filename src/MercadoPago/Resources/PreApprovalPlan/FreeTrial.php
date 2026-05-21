<?php

namespace MercadoPago\Resources\PreApprovalPlan;

use MercadoPago\Serialization\Mapper;

/**
 * PreApproval Plan Free Trial resource.
 *
 * Defines the free trial period for a subscription plan. During this period,
 * the subscriber is not charged. Specifies how long the trial lasts via
 * frequency and frequency_type, and when the first invoice is generated.
 */
class FreeTrial
{
    /** Frequency. */
    public ?int $frequency;

    /** Frequency type. */
    public ?string $frequency_type;

    /** First invoice offset. */
    public ?int $first_invoice_offset;
}
