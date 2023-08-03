<?php

namespace MercadoPago\Resources\Payment;

/** ReceiverAddress class. */
class ReceiverAddress extends Address
{
    /** State. */
    public $state_name;

    /** City. */
    public $city_name;

    /** Floor. */
    public $floor;

    /** Apartment. */
    public $apartment;
}
