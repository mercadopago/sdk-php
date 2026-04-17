<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** OrderSearch class. */
class OrderSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public array|object|null $paging;

    /** Search data. */
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
