<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Resources\Common\Address;

/** ReceiverAddress class. */
class ReceiverAddress extends Address
{
    /** Street name. */
    public ?string $street_name;

    /** Apartment. */
    public ?string $apartment;

    /** City. */
    public ?string $city_name;

    /** Floor. */
    public ?string $floor;

    /** Província */
    public ?string $state_name;
}
