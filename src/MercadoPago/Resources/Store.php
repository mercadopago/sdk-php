<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Store resource.
 *
 * Represents a MercadoPago store (physical location) associated with a user/seller.
 * Stores are used to group points of sale (POS) and carry business hours and
 * location information.
 *
 * @property array|object|null $location Store location data (address, city, state, etc.).
 * @property array|object|null $business_hours Store opening hours per weekday.
 *
 * @see \MercadoPago\Client\Store\StoreClient
 */
class Store extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** The store's ID. */
    public ?int $id;

    /** The ID of the user (seller) the store belongs to. */
    public ?int $user_id;

    /** The store's name. */
    public ?string $name;

    /** The date the store was created. */
    public ?string $date_created;

    /** External identifier assigned by the integrator. */
    public ?string $external_id;

    /** Store location data. */
    public array|object|null $location;

    /** Store opening hours per weekday. */
    public array|object|null $business_hours;

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return [];
    }
}
