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
    /** Card number length. */
    public ?int $length;

    /** Card number validation. */
    public ?string $validation;
}
