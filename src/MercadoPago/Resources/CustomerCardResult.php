<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Wrapper resource for a list of cards belonging to a customer.
 *
 * Returned when listing all saved cards for a given customer. The actual card
 * entries are contained in the {@see $data} property as an array of
 * {@see \MercadoPago\Resources\Customer\CustomerCardListResult} objects.
 *
 * @see \MercadoPago\Client\Customer\CustomerCardClient
 */
class CustomerCardResult extends MPResource
{
    use Mapper;

    /** Array of card records returned by the API. */
    public array|object|null $data;

    /**
     * Maps nested JSON properties to their corresponding DTO classes.
     *
     * @var array<string, class-string>
     */
    private $map = [
        "data" => "MercadoPago\Resources\Customer\CustomerCardListResult",
    ];

    /**
     * Returns the property-to-class mapping for nested object deserialization.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
