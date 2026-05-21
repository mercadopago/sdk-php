<?php

namespace MercadoPago\Resources\Common;

/**
 * Represents a city within the MercadoPago API.
 *
 * Used as a nested DTO inside {@see Address} to identify the city
 * portion of a physical address.
 */
class City
{
    /** MercadoPago internal identifier for the city. */
    public ?string $id;

    /** Human-readable name of the city. */
    public ?string $name;
}
