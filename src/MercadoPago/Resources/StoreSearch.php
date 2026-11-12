<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Store Search resource.
 *
 * Represents the paginated result set returned when searching for stores
 * under a user account. Contains the matching stores along with pagination metadata.
 *
 * @property array|object|null $elements Search results, mapped to {@see \MercadoPago\Resources\Store}.
 * @property int|null $next_offset Offset for retrieving the next page of results.
 * @property int|null $total Total number of stores matching the search criteria.
 *
 * @see \MercadoPago\Client\Store\StoreClient
 */
class StoreSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search elements. */
    public array|object|null $elements;

    /** Search next offset. */
    public ?int $next_offset;

    /** Search total. */
    public ?int $total;

    private $map = [
        "elements" => "MercadoPago\Resources\Store",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
