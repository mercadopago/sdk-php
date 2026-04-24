<?php

namespace MercadoPago\Resources\User;

/**
 * User Context resource.
 *
 * Contains contextual information about the user's current session,
 * such as their IP address.
 */
class Context
{
    /** The user's IP address. */
    public ?string $ip_address;
}
