<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Shipping Speed resource.
 *
 * Represents the time breakdown for a shipping option, splitting the total
 * delivery time into handling (preparation) and shipping (transit) components.
 */
class ShippingSpeed
{
    /** Handling time. */
    public ?int $handling;

    /** Shipping time. */
    public ?int $shipping;
}
