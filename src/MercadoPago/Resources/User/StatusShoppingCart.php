<?php

namespace MercadoPago\Resources\User;

/**
 * User Status Shopping Cart resource.
 *
 * Represents the shopping cart permissions for a user account,
 * indicating whether buying and selling through the cart are allowed.
 */
class StatusShoppingCart
{
    /** Indicates whether buying from the shopping cart is allowed. */
    public ?string $buy;

    /** Indicates whether selling from the shopping cart is allowed. */
    public ?string $sell;
}
