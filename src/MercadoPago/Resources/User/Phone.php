<?php

namespace MercadoPago\Resources\User;

/** Phone class. */
class Phone
{
    /** The area code of the user's phone number. */
    public ?string $area_code;

    /** The extension of the user's phone number (if available). */
    public ?string $extension;

    /** The user's phone number. */
    public ?string $number;

    /** Indicates whether the user's phone number is verified (true/false). */
    public ?bool $verified;
}
