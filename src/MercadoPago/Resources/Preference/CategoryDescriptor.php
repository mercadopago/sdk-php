<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Serialization\Mapper;

/**
 * Preference Category Descriptor resource.
 *
 * Provides additional category-specific metadata for a preference item, typically used
 * for travel or event-related purchases (e.g. passenger name, route, event date).
 *
 * Fields are mapped to typed DTOs:
 * - passenger -> {@see \MercadoPago\Resources\Preference\Passenger}
 * - route -> {@see \MercadoPago\Resources\Preference\Route}
 */
class CategoryDescriptor
{
    /** Class mapper. */
    use Mapper;

    /** Event date. */
    public ?string $event_date;

    /** @var Passenger|array|null Passenger information. */
    public array|object|null $passenger;

    /** @var Route|array|null Route information. */
    public array|object|null $route;

    private $map = [
        "passenger" => "MercadoPago\Resources\Preference\Passenger",
        "route" => "MercadoPago\Resources\Preference\Route",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
