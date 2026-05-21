<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Resources\Common\Address;

/**
 * Represents the shipping destination address for a payment in the MercadoPago API.
 *
 * Extends the base {@see \MercadoPago\Resources\Common\Address} with additional
 * fields specific to shipment delivery (apartment, floor, city name).
 * Nested within {@see Shipments}.
 */
class ReceiverAddress extends Address
{
    /** Name of the street at the delivery address. */
    public ?string $street_name;

    /** Name of the state/province at the delivery address. */
    public ?string $state_name;

    /** Apartment or unit number at the delivery address. */
    public ?string $apartment;

    /** City name at the delivery address. */
    public ?string $city_name;

    /** Floor number within the building at the delivery address. */
    public ?string $floor;
}
