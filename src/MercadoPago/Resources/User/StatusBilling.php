<?php

namespace MercadoPago\Resources\User;

/**
 * User Status Billing resource.
 *
 * Represents the billing permission status for a user account,
 * indicating whether billing is allowed and any associated status codes.
 */
class StatusBilling
{
    /** Indicates whether billing is allowed (true/false). */
    public ?bool $allow;

    /** Billing status codes. */
    public ?array $codes;
}
