<?php

namespace MercadoPago\Resources\Common;

/** Address class. */
class Address
{
    /** Addess ID. */
    public ?string $id;

    /** Zip code. */
    public ?string $zip_code;

    /** Street name. */
    public ?string $street_name;

    /** Street number. */
    public ?int $street_number;

    /** City. */
    public ?string $city;
}
