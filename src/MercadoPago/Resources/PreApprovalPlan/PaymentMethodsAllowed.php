<?php

namespace MercadoPago\Resources\PreApprovalPlan;

use MercadoPago\Serialization\Mapper;

/** PaymentMethodsAllowed class. */
class PaymentMethodsAllowed
{
    /** Payment types. */
    public ?array $payment_types;

    /** Payment methods. */
    public ?array $payment_methods;

}
