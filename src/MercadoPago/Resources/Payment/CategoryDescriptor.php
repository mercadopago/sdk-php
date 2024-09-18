<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** CategoryDescriptor class. */
class CategoryDescriptor
{
    /** Class mapper. */
    use Mapper;

    /** Object passenger */
    public array|object|null $passenger;

    /** Object Route*/
    public array|object|null $route;


    private $map = [
      "passenger" => "MercadoPago\Resources\Common\Passenger",
      "route" => "MercadoPago\Resources\Common\Route",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
