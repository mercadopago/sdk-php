<?php

namespace MercadoPago\Resources\User;

/**
 * User Alternative Phone resource.
 *
 * Represents a secondary/alternative phone number associated with a user account,
 * including area code, phone number, and optional extension.
 */
class AlternativePhone
{
    /** The area code of the user's phone number. */
    public ?string $area_code;

    /** The extension of the user's phone number (if available). */
    public ?string $extension;

    /** The user's phone number. */
    public ?string $number;
}
