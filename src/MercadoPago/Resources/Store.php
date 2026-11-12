<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Store resource.
 *
 * Represents a physical store registered in the MercadoPago platform, used to
 * associate orders and payments with a specific branch or location.
 *
 * @property string|null $id Store ID.
 * @property string|null $name Store name.
 * @property int|null $user_id User identifier that owns the store.
 * @property array|object|null $business_hours Store business hours.
 * @property array|object|null $location Store location (address and coordinates).
 * @property string|null $external_id External identifier you can synchronize with your own system.
 * @property string|null $date_created Date of creation.
 * @property string|null $date_last_updated Last modified date.
 *
 * @see \MercadoPago\Client\Store\StoreClient
 */
class Store extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Store ID. */
    public ?string $id;

    /** Store name. */
    public ?string $name;

    /** User identifier that owns the store. */
    public ?int $user_id;

    /** Store business hours. */
    public array|object|null $business_hours;

    /** Store location. */
    public array|object|null $location;

    /** External identifier you can synchronize with your system. */
    public ?string $external_id;

    /** Date of creation. */
    public ?string $date_created;

    /** Last modified date. */
    public ?string $date_last_updated;

    private $map = [
        "business_hours" => "array",
        "location" => "object",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
