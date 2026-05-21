<?php

namespace MercadoPago\Resources\User;

/**
 * User Credit resource.
 *
 * Represents the MercadoPago credit/lending information for a user account,
 * including consumed credit amount, credit level, and rank classification.
 */
class Credit
{
    /** The amount of consumed credit. */
    public ?int $consumed;

    /** The credit level ID. */
    public ?string $credit_level_id;

    /** The user's credit rank. */
    public ?string $rank;
}
