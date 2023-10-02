<?php

namespace MercadoPago\Resources\User;

/** StatusBilling class. */
class StatusBilling
{
    /** Indicates whether billing is allowed (true/false). */
    public ?bool $allow;

    /** Billing status codes. */
    public ?array $codes;
}
