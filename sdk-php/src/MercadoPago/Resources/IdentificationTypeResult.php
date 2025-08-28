<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** IdentificationTypeResult class. */
class IdentificationTypeResult extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Identification Type Result data. */
    public array|object|null $data;

    private $map = [
        "data" => "MercadoPago\Resources\IdentificationType\IdentificationTypeListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
