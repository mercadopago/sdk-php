<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Store resource for the MercadoPago Stores API.
 *
 * Represents a physical store registered by a seller, including its business
 * hours and geographic location. Returned by the store create, get, and
 * update operations.
 *
 * @see \MercadoPago\Client\Store\StoreClient
 */
class Store extends MPResource
{
    use Mapper;

    /** Store ID. */
    public $id;

    /** ID of the user (seller) that owns the store. */
    public $user_id;

    /** Store name. */
    public ?string $name;

    /** Store creation date. */
    public ?string $date_created;

    /** Date of the last store update. */
    public ?string $date_last_updated;

    /** External identifier assigned by the integrator. */
    public ?string $external_id;

    /** Store geographic location. */
    public array|object|null $location;

    /** Store business hours. */
    public array|object|null $business_hours;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
