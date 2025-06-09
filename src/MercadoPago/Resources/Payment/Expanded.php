<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Expanded class. */
class Expanded
{
    /** Class mapper. */
    use Mapper;

    /** Gateway data. */
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

/** Gateway class for expanded response. */
class ExpandedGateway
{
    /** Class mapper. */
    use Mapper;

    /** Reference data. */
    public ?object $reference;

    private $map = [
        "reference" => "MercadoPago\Resources\Payment\ExpandedGatewayReference",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}

/** GatewayReference class for expanded response. */
class ExpandedGatewayReference
{
    /** Network transaction ID. */
    public ?string $network_transaction_id;
} 