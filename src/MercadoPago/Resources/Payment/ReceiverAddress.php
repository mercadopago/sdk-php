<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Resources\Common\Address;

/** ReceiverAddress class. */
class ReceiverAddress extends Address
{
    /** Street name. */
    public ?string $street_name;

    // /** Street number. */
    // public ?int $street_number;

    // /** Zip code. */
    // public ?string $zip_code;

    /** City. */
    public ?string $city_name;

    // /** State name. */
    // public ?string $state_name;
}
