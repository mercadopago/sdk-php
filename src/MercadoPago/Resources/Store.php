<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Store resource.
 *
 * Represents a MercadoPago store (physical location) used by Point and
 * in-person payments. The response schema is kept opaque to the spec:
 * only documented top-level fields are exposed and no requiredness is
 * invented.
 *
 * @property array|object|null $business_hours Store business hours.
 * @property array|object|null $location Store location.
 *
 * @see \MercadoPago\Client\Store\StoreClient
 */
class Store extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** The store's ID. */
    public ?int $id;

    /** The user's (seller's) ID that owns the store. */
    public ?int $user_id;

    /** The store's name. */
    public ?string $name;

    /** The date and time the store was created. */
    public ?string $date_created;

    /** The date and time the store was last updated. */
    public ?string $date_last_updated;

    /** Store business hours. */
    public array|object|null $business_hours;

    /** Store location data. */
    public array|object|null $location;

    /** External identifier set by the integrator. */
    public ?string $external_id;

    /** The store's status (e.g., "active"). */
    public ?string $status;

    public $map = [];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
