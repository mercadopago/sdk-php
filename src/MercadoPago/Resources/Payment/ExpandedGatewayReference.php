<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents gateway reference identifiers from the card network.
 */
class ExpandedGatewayReference
{
    use Mapper;

    /** Unique transaction identifier assigned by the card network (e.g. Visa, Mastercard). */
    public ?string $network_transaction_id;

    /** @var NetworkData|array|null Card-network identifiers returned by the gateway. */
    public array|object|null $network_data;

    private $map = [
        "network_data" => "MercadoPago\\Resources\\Payment\\NetworkData",
    ];

    public function getMap(): array
    {
        return $this->map;
    }
}
