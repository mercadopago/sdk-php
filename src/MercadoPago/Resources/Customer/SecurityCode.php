<?php

namespace MercadoPago\Resources\Customer;

/** Security Code class. */
class SecurityCode
{
    /** Length of security code. */
    public ?int $length;

    /** Location of security code in the card. */
    public ?string $card_location;

}
