<?php

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** CategoryDescriptor class. */
class CategoryDescriptor
{
    /** Class mapper. */
    use Mapper;

    /** Event date. */
    public ?string $event_date;

    /** Passenger. */
    public array|object|null $passenger;

    /** Route. */
    public array|object|null $route;

    private $map = [
        "passenger" => "MercadoPago\Resources\Order\Passenger",
        "route" => "MercadoPago\Resources\Order\Route",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
