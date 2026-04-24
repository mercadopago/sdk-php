<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Free Shipping Method resource.
 *
 * Identifies a shipping method that should be offered as free shipping within a preference.
 * Used in "me2" (MercadoEnvios) shipping mode to subsidize specific carrier methods.
 */
class FreeMethod
{
    /** Shipping method ID. */
    public ?int $id;
}
