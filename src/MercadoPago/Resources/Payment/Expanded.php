<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents expanded response data included in a payment when gateway mode is used.
 *
 * Contains additional gateway-level information such as network transaction references.
 * Nested within {@see \MercadoPago\Resources\Payment} when expanded fields are requested.
 */
class Expanded
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var ExpandedGateway|null Gateway-specific response data including network references. */
    public ?object $gateway;

    private $map = [
        "gateway" => "MercadoPago\Resources\Payment\ExpandedGateway",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
