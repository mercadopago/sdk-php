<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Preference Search resource.
 *
 * Represents the paginated result set returned when searching for checkout preferences.
 * Contains matching preference summaries along with pagination metadata.
 *
 * @property array $elements Search results, mapped to {@see \MercadoPago\Resources\Preference\PreferenceListResult}.
 * @property int|null $next_offset Offset for retrieving the next page of results.
 * @property int|null $total Total number of preferences matching the search criteria.
 *
 * @see \MercadoPago\Client\Preference\PreferenceClient
 */
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
