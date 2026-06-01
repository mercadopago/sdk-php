<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Chargeback Search resource.
 *
 * Represents the paginated result set returned when searching for chargebacks.
 *
 * @property array|object|null $paging Pagination info, mapped to {@see \MercadoPago\Resources\Common\Paging}.
 * @property array|object|null $results Search results, mapped to {@see \MercadoPago\Resources\Chargeback}.
 *
 * @see \MercadoPago\Client\Chargeback\ChargebackClient
 */
class ChargebackSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public array|object|null $paging;

    /** Search results. */
    public array|object|null $results;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\Chargeback",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
