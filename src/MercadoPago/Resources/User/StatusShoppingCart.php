<?php

namespace MercadoPago\Resources\User;

/** StatusShoppingCart class. */
class StatusShoppingCart
{
    /** Indicates whether buying from the shopping cart is allowed. */
    public ?string $buy;

    /** Indicates whether selling from the shopping cart is allowed. */
    public ?string $sell;
}
