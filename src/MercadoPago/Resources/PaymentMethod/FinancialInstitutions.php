<?php

namespace MercadoPago\Resources\PaymentMethod;

/**
 * Payment Method Financial Institution resource.
 *
 * Represents a bank or financial institution associated with a payment method,
 * typically used for bank transfer payment types where the buyer selects their bank.
 */
class FinancialInstitutions
{
    /** Financial institution ID. */
    public ?int $id;

    /** Financial institution description. */
    public ?string $description;
}
