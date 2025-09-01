<?php

namespace MercadoPago\Resources\User;

/** Address class. */
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
