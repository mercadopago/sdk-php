<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Category Descriptor resource.
 *
 * Provides additional category-specific metadata for a preference item, typically used
 * for travel or event-related purchases (e.g. passenger name, route, event date).
 */
class CategoryDescriptor
{
    /** Event date. */
    public ?string $event_date;

    /** Passenger name. */
    public ?string $passenger;

    /** Route description. */
    public ?string $route;
}
