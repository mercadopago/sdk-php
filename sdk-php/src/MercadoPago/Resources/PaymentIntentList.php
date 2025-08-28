<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** PaymentIntentList class. */
class PaymentIntentList extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Events. */
    public array|object|null $events;

    private $map = [
        "events" => "MercadoPago\Resources\Point\Events",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
