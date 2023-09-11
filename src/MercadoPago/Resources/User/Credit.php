<?php

namespace MercadoPago\Resources\User;

/** Credit class. */
class Credit
{
    /** The amount of consumed credit. */
    public ?int $consumed;

    /** The credit level ID. */
    public ?string $credit_level_id;

    /** The user's credit rank. */
    public ?string $rank;
}
