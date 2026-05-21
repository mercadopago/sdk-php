<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Resources\Common\Phone as Base;

/**
 * User Phone resource.
 *
 * Extends the common {@see \MercadoPago\Resources\Common\Phone} with a verification
 * flag indicating whether the user's phone number has been confirmed.
 */
class Phone extends Base
{
    /** Indicates whether the user's phone number is verified (true/false). */
    public ?bool $verified;
}
