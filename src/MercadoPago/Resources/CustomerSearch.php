<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Paginated search result for customers in the MercadoPago platform.
 *
 * Returned by the customer search endpoint. Contains pagination metadata and an
 * array of matching customer records. Use filters such as email or identification
 * to narrow results.
 *
 * @see \MercadoPago\Client\Customer\CustomerClient
 */
class CustomerSearch extends MPResource
{
    use Mapper;

    /** Pagination metadata (offset, limit, total). */
    public array|object|null $paging;

    /** Array of customer records matching the search criteria. */
    public array|object|null $results;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\Customer\CustomerSearchResult",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
