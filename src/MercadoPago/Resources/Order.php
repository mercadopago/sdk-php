<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

class Order extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Order ID. */
    public ?string $id;

    /** Type. */
    public ?string $type;

    /** External reference. */
    public ?string $external_reference;

    /** Country code. */
    public ?string $country_code;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /**  Capture mode. */
    public ?string $capture_mode;

    /** User ID. */
    public ?string $user_id;

    /** Client token. */
    public ?string $client_token;

    /** Total amount. */
    public ?string $total_amount;

    /** Total paid amount. */
    public ?string $total_paid_amount;

    /** Processing mode. */
    public ?string $processing_mode;

    /** Description. */
    public ?string $description;

    /** Marketplace. */
    public ?string $marketplace;

    /** Marketplace fee. */
    public ?string $marketplace_fee;

    /** Created date. */
    public ?string $created_date;

    /** Last updated date. */
    public ?string $last_updated_date;

    /** Checkout available at. */
    public ?string $checkout_available_at;

    /** Expiration time. */
    public ?string $expiration_time;

    /** Integration data. */
    public array|object|null $integration_data;

    /** Payer. */
    public array|object|null $payer;

    /** Transactions. */
    public array|object|null $transactions;

    /** Items. */
    public ?array $items;

    /** Config. */
    public array|object|null $config;

    /** Additional info. */
    public ?array $additional_info;

    private $map = [
        "transactions" => "MercadoPago\Resources\Order\Transactions",
        "items" => "MercadoPago\Resources\Order\Items",
        "integration_data" => "MercadoPago\Resources\Order\IntegrationData",
        "payer" => "MercadoPago\Resources\Order\Payer",
        "config" => "MercadoPago\Resources\Order\Config",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
