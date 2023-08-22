<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Resources\Common\Address;

/** ReceiverAddress class. */
class ReceiverAddress extends Address
{
    /** Country. */
    public ?string $country_name;

    /** State. */
    public ?string $state_name;

    /** Floor. */
    public ?string $floor;

    /** Apartment. */
    public ?string $apartment;

    /** City name. */
    public ?string $city_name;
}
