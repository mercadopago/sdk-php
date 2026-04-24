<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents a paginated search result for MercadoPago Orders.
 *
 * Returned by the Orders search endpoint, this resource wraps paging metadata
 * and the list of matching {@see Order} resources.
 *
 * @see \MercadoPago\Client\Order\OrderClient
 */
class OrderSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Pagination metadata (offset, limit, total). Maps to {@see \MercadoPago\Resources\Common\Paging}. */
    public array|object|null $paging;

    /** Array of {@see Order} resources matching the search criteria. */
    public array|object|null $data;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "data" => "MercadoPago\Resources\Order",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
