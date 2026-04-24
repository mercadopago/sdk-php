<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Point Devices list resource.
 *
 * Represents the paginated list of Point smart terminal devices associated with
 * the seller's account. Each device entry includes its ID, POS/store association,
 * and operating mode.
 *
 * @property array|object|null $paging Pagination info, mapped to {@see \MercadoPago\Resources\Common\Paging}.
 * @property array|object|null $devices Device list, mapped to {@see \MercadoPago\Resources\Point\Device}.
 *
 * @see \MercadoPago\Client\Point\PointClient
 */
class PointDevices extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public array|object|null $paging;

    /** Devices. */
    public array|object|null $devices;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "devices" => "MercadoPago\Resources\Point\Device",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
