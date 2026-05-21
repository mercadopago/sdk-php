<?php

namespace MercadoPago\Resources\Common;

/**
 * Represents a differential pricing configuration in the MercadoPago API.
 *
 * Differential pricing allows sellers to offer different installment plans
 * or financing conditions for specific payment scenarios. The ID references
 * a pre-configured pricing plan on the MercadoPago platform.
 */
class DifferentialPricing
{
    /** Unique identifier of the differential pricing configuration. */
    public ?int $id;
}
