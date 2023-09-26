<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** PaymentSearch class. */
class PaymentSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public object|array|null $paging;

    /** Search results. */
    public object|array|null $results;

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
