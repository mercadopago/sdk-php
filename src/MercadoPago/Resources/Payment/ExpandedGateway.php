<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the gateway section of expanded payment data.
 */
class ExpandedGateway
{
    use Mapper;

    /** @var ExpandedGatewayReference|null Reference identifiers returned by the gateway. */
    public ?object $reference;

    private $map = [
        "reference" => "MercadoPago\\Resources\\Payment\\ExpandedGatewayReference",
    ];

    public function getMap(): array
    {
        return $this->map;
    }
}
