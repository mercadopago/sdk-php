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

    /** Expected security code length (e.g., 3 for CVV, 4 for Amex CID). */
    public ?int $length;

    /** Physical location on the card ("back" for most cards, "front" for Amex). */
    public ?string $card_location;
}
