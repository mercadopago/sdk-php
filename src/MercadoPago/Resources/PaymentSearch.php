<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents the paginated result of a payment search query in the MercadoPago API.
 *
 * Returned by {@see \MercadoPago\Client\Payment\PaymentClient::search()} and contains
 * pagination metadata along with the list of matching payments.
 */
class PaymentSearch extends MPResource
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var \MercadoPago\Resources\Common\Paging|array|null Pagination metadata (total, limit, offset). */
    public array|object|null $paging;

    /** @var PaymentSearchResult[]|array|null List of payments matching the search criteria. */
    public array|object|null $results;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\Payment\PaymentSearchResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
