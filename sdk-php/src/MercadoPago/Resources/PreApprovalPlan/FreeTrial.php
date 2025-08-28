<?php

namespace MercadoPago\Resources\PreApprovalPlan;

use MercadoPago\Serialization\Mapper;

/** FreeTrial class. */
class FreeTrial
{
    /** Frequency. */
    public ?int $frequency;

    /** Frequency type. */
    public ?string $frequency_type;

    /** First invoice offset. */
    public ?int $first_invoice_offset;
}
