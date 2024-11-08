<?php

namespace MercadoPago\Resources\Order;

/** ReceiverAddress class. */
class ReceiverAddress
{
    /** Street name. */
    public ?string $street_name;

    /** Street number. */
    public ?string $street_number;

    /** ZIP code. */
    public ?string $zip_code;

    /** City name. */
    public ?string $city_name;

    /** State name. */
    public ?string $state_name;

    /** Floor. */
    public ?string $floor;

    /** Apartment. */
    public ?string $apartment;
}
