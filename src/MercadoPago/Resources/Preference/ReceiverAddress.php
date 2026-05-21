<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Resources\Common\Address;

/**
 * Preference Receiver Address resource.
 *
 * Represents the shipping destination address within a preference's shipment configuration.
 * Extends the common {@see \MercadoPago\Resources\Common\Address} with additional fields
 * for country name, state name, floor, apartment, and city name.
 */
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
