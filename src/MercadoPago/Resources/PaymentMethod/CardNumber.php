<?php

namespace MercadoPago\Resources\PaymentMethod;

/**
 * Payment Method Card Number settings resource.
 *
 * Defines the expected card number length and validation algorithm (e.g. "standard",
 * "none") for a payment method's card number input.
 */
class CardNumber
{
    /** Expected card number length (e.g., 16 for Visa/Mastercard, 15 for Amex). */
    public ?int $length;

    /** Validation algorithm applied to the card number (e.g., "standard" for Luhn check). */
    public ?string $validation;
}
