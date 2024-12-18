<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

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

    /**  Capture mode. */
    public ?string $capture_mode;

    /** Payer. */
    public array|object|null $payer;

    /** Transactions. */
    public array|object|null $transactions;

    /** Items. */
    public ?array $items;

    private $map = [
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
