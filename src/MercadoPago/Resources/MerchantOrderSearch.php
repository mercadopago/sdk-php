<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Merchant Order Search resource.
 *
 * Represents the paginated result set returned when searching for merchant orders.
 * Contains a list of matching merchant orders along with pagination metadata.
 *
 * @property array|object|null $elements Search results, mapped to {@see \MercadoPago\Resources\MerchantOrder\MerchantOrderSearchResult}.
 * @property int|null $next_offset Offset for retrieving the next page of results.
 * @property int|null $total Total number of merchant orders matching the search criteria.
 *
 * @see \MercadoPago\Client\MerchantOrder\MerchantOrderClient
 */
class MerchantOrderSearch extends MPResource
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
        "elements" => "MercadoPago\Resources\MerchantOrder\MerchantOrderSearchResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
