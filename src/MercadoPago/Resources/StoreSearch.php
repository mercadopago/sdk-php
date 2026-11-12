<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Paginated search result for stores in the MercadoPago platform.
 *
 * Returned by the store search endpoint. Contains pagination metadata and an
 * array of matching store records.
 *
 * @see \MercadoPago\Client\Store\StoreClient
 */
class StoreSearch extends MPResource
{
    use Mapper;

    /** Pagination metadata (offset, limit, total). */
    public array|object|null $paging;

    /** Array of store records matching the search criteria. */
    public array|object|null $results;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\Store",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
