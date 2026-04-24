<?php

namespace MercadoPago\Resources\User;

/**
 * User Address resource.
 *
 * Represents the registered address of a MercadoPago/MercadoLibre user account,
 * including street address, city, state code, and postal code.
 */
class Address
{
    /** The user's address. */
    public ?string $address;

    /** The city where the user is located. */
    public ?string $city;

    /** The state code where the user is located (e.g., "BR-SP" for São Paulo, Brazil). */
    public ?string $state;

    /** The ZIP code of the user's location. */
    public ?string $zip_code;
}
