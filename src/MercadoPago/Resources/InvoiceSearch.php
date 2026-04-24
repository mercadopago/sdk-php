<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Invoice Search resource.
 *
 * Represents the paginated result set returned when searching for subscription invoices.
 * Contains matching invoice records along with pagination metadata.
 *
 * @property array|object|null $paging Pagination info, mapped to {@see \MercadoPago\Resources\Common\Paging}.
 * @property array|object|null $results Invoice search results, mapped to {@see \MercadoPago\Resources\Invoice\InvoiceSearchResult}.
 *
 * @see \MercadoPago\Client\Invoice\InvoiceClient
 */
class InvoiceSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public array|object|null $paging;

    /** Search results. */
    public array|object|null $results;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\Invoice\InvoiceSearchResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
