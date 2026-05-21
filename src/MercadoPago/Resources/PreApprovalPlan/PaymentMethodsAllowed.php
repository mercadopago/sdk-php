<?php

namespace MercadoPago\Resources\PreApprovalPlan;

use MercadoPago\Serialization\Mapper;

/**
 * PreApproval Plan Allowed Payment Methods resource.
 *
 * Specifies which payment types and specific payment methods are permitted
 * for subscriptions created under this plan.
 */
class PaymentMethodsAllowed
{
    /** Payment types. */
    public ?array $payment_types;

    /** Payment methods. */
    public ?array $payment_methods;

}
