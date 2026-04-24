<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Payment Intent List resource (Point integration).
 *
 * Represents the list of payment intent events for a Point device. Each event
 * contains the intent ID, status, and creation timestamp.
 *
 * @property array|object|null $events Payment intent events, mapped to {@see \MercadoPago\Resources\Point\Events}.
 *
 * @see \MercadoPago\Client\Point\PointClient
 */
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
