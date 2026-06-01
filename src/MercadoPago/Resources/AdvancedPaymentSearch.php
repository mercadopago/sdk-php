<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Advanced Payment Search resource.
 *
 * Represents the paginated result set returned when searching for advanced payments.
 *
 * @property array|object|null $paging Pagination info, mapped to {@see \MercadoPago\Resources\Common\Paging}.
 * @property array|object|null $results Search results, mapped to {@see \MercadoPago\Resources\AdvancedPayment}.
 *
 * @see \MercadoPago\Client\AdvancedPayment\AdvancedPaymentClient
 */
class AdvancedPaymentSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public array|object|null $paging;

    /** Search results. */
    public array|object|null $results;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\AdvancedPayment",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
