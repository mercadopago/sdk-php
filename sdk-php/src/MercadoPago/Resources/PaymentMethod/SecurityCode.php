<?php

namespace MercadoPago\Resources\PaymentMethod;

/** SecurityCode class. */
class SecurityCode
{
    /** Security code mode. */
    public ?string $mode;

    /** Security code length. */
    public ?int $length;

    /** Security code card location. */
    public ?string $card_location;
}
