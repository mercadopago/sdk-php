<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Resources\Common\Phone as Base;

/** Phone class. */
class Phone extends Base
{
    /** Indicates whether the user's phone number is verified (true/false). */
    public ?bool $verified;
}
