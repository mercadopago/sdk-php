<?php

/** Swagger version: 54cea3ac-c258-4a6f-aea9-988e641cff30 */

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

class Order extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Order ID. */
    public ?string $id;

    /** Processing mode. */
    public ?string $processing_mode;

    /** External reference. */
    public ?string $external_reference;

    /** Description. */
    public ?string $description;

    /** Marketplace. */
    public ?string $marketplace;

    /** Marketplace fee. */
    public ?string $marketplace_fee;

    /** Campaign ID. */
    public ?string $campaign_id;

    /** Total amount. */
    public ?string $total_amount;

    /** Currency. */
    public ?string $currency;

    /** Expiration time. */
    public ?string $expiration_time;

    /** Site ID. */
    public ?string $site_id;

    /** Client ID. */
    public ?string $client_id;

    /** Collector ID. */
    public ?string $collector_id;

    /** Created date. */
    public ?string $created_date;

    /** Last updated date. */
    public ?string $last_updated_date;

    /** Type. */
    public ?string $type;

    /** Status. */
    public ?string $status;

    /** Type config. */
    public array|object|null $type_config;

    /** Payer. */
    public array|object|null $payer;

    /** Transactions. */
    public array|object|null $transactions;

    /** Shipment. */
    public array|object|null $shipment;

    /** Items. */
    public ?array $items;

    private $map = [
        "type_config" => "MercadoPago\Resources\Order\TypeConfig",
        "payer" => "MercadoPago\Resources\Order\Payer",
        "transactions" => "MercadoPago\Resources\Order\Transactions",
        "shipment" => "MercadoPago\Resources\Order\Shipment",
        "items" => "MercadoPago\Resources\Order\Items",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
