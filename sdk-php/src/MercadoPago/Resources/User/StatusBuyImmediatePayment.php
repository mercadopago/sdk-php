<?php

namespace MercadoPago\Resources\User;

/** StatusBuyImmediatePayment class. */
class StatusBuyImmediatePayment
{
    /** Reasons for immediate payment. */
    public ?array $reasons;

    /** Indicates whether immediate payment is required for buying (true/false). */
    public ?bool $required;
}
