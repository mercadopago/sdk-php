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
    /** Unique identifier of the financial institution in the MercadoPago catalog. */
    public ?int $id;

    /** Human-readable name of the financial institution (e.g., "Banco Nacion", "Bradesco"). */
    public ?string $description;
}
