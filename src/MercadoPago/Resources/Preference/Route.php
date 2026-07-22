<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Route resource.
 *
 * Represents a travel route associated with a travel-related preference item.
 */
class Route
{
    /** Departure location. */
    public ?string $departure;

    /** Destination location. */
    public ?string $destination;

    /** ISO 8601 date and time of departure. */
    public ?string $departure_date_time;

    /** ISO 8601 date and time of arrival. */
    public ?string $arrival_date_time;

    /** Carrier or company name. */
    public ?string $company;
}
