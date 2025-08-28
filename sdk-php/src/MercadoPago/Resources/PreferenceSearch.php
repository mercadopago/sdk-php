<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** PreferenceSearch class. */
class PreferenceSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search elements. */
    public array $elements;

    /** Search next offset. */
    public ?int $next_offset;

    /** Search total. */
    public ?int $total;

    private $map = [
        "elements" => "MercadoPago\Resources\Preference\PreferenceListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
