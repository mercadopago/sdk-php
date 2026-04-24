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

/**
 * Represents the gateway section of expanded payment data.
 *
 * Contains reference information from the payment gateway/acquirer.
 */
class ExpandedGateway
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var ExpandedGatewayReference|null Reference identifiers returned by the gateway. */
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

/**
 * Represents gateway reference identifiers from the card network.
 *
 * Used for recurring payment flows and acquirer reconciliation when
 * a network transaction ID is required for subsequent transactions.
 */
class ExpandedGatewayReference
{
    /** Unique transaction identifier assigned by the card network (e.g. Visa, Mastercard). */
    public ?string $network_transaction_id;
}
