<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/**
 * Store resource for the MercadoPago Stores API.
 *
 * Represents a physical store associated with a seller user, used for
 * in-person payments (Point of Sale) and pickup/delivery flows.
 *
 * @see \MercadoPago\Client\Store\StoreClient
 */
class Store extends MPResource
{
    /** Store ID. */
    public ?int $id;

    /** Merchant ID the store belongs to. */
    public ?int $merchant_id;

    /** External identifier of the store (set by the integrator). */
    public ?string $external_id;

    /** Store name. */
    public ?string $name;

    /** Store location (address, city, state, etc.). */
    public array|object|null $location;

    /** Business hours of the store. */
    public array|object|null $business_hours;

    /** Date when the store was created. */
    public ?string $date_created;

    /** Date when the store was last updated. */
    public ?string $date_last_updated;
}
