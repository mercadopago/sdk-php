<?php

namespace MercadoPago\Resources\User;

/** AlternativePhone class. */
class AlternativePhone
{
    /** The area code of the user's phone number. */
    public ?string $area_code;

    /** The extension of the user's phone number (if available). */
    public ?string $extension;

    /** The user's phone number. */
    public ?string $number;
}
