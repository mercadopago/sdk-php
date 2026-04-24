<?php

namespace MercadoPago\Resources\PaymentMethod;

/**
 * Payment Method Security Code settings resource.
 *
 * Defines the security code (CVV/CVC) requirements for a payment method,
 * including its length, input mode, and physical location on the card.
 */
class SecurityCode
{
    /** Security code mode. */
    public ?string $mode;

    /** Security code length. */
    public ?int $length;

    /** Security code card location. */
    public ?string $card_location;
}
