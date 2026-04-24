<?php

namespace MercadoPago\Resources\User;

/**
 * User Status Immediate Payment resource.
 *
 * Represents the immediate payment requirement for a user's buy/sell actions,
 * indicating whether immediate payment is required and the reasons for it.
 */
class StatusBuyImmediatePayment
{
    /** Reasons for immediate payment. */
    public ?array $reasons;

    /** Indicates whether immediate payment is required for buying (true/false). */
    public ?bool $required;
}
