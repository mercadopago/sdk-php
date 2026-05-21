<?php

namespace MercadoPago\Resources\Customer;

/**
 * Describes the security code (CVV/CVC) configuration for a payment card.
 *
 * Indicates how many digits the security code has and where it is physically
 * located on the card. Used as a nested object within {@see \MercadoPago\Resources\CustomerCard}
 * and {@see \MercadoPago\Resources\Customer\CustomerCardListResult}.
 */
class SecurityCode
{
    /** Number of digits in the security code (typically 3 or 4). */
    public ?int $length;

    /** Physical location of the security code on the card (e.g., "back", "front"). */
    public ?string $card_location;

}
