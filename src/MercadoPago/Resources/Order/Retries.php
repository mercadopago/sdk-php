<?php

namespace MercadoPago\Resources\Order;

/**
 * Represents the payment retry configuration for a Checkout PRO order.
 *
 * Controls whether automatic payment retries are enabled when a payment
 * attempt fails within the checkout flow.
 *
 * @see \MercadoPago\Resources\Order\OnlineConfig
 */
class Retries
{
    /** Whether automatic payment retry is enabled. When false, a failed attempt ends the order. */
    public ?bool $allowed;
}
