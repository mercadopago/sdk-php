<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** ChargebackSearch class. */
class ChargebackSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Paging information. */
    public array|object|null $paging;

    /** List of chargebacks. */
    public ?array $results;

    private $map = [
        "results" => "MercadoPago\Resources\Chargeback",
        "paging" => "MercadoPago\Resources\Common\Paging",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
} 