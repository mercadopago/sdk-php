<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

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

    /** Total amount. */
    public ?string $total_amount;

    /** Expiration time. */
    public ?string $expiration_time;

    /** Site ID. */
    public ?string $site_id;

    /** Created date. */
    public ?string $created_date;

    /** Last updated date. */
    public ?string $last_updated_date;

    /** Type. */
    public ?string $type;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /** Type config. */
    public array|object|null $type_config;

    /** Payer. */
    public array|object|null $payer;

    /** Transactions. */
    public array|object|null $transactions;

    /** Items. */
    public ?array $items;

    private $map = [
        "type_config" => "MercadoPago\Resources\Order\TypeConfig",
        "payer" => "MercadoPago\Resources\Order\Payer",
        "transactions" => "MercadoPago\Resources\Order\Transactions",
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
