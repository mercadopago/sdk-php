<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** AdditionalInfo class. */
class AdditionalInfo
{
    /** Class mapper. */
    use Mapper;

    /** IP from where the request comes from (only for bank transfers). */
    public ?string $ip_address;

    /** The ID of tracking. */
    public ?string $tracking_id;

    /** List of items to be paid. */
    public ?array $items;

    /** Payer's information. */
    public array|object|null $payer;

    /** Shipping information. */
    public array|object|null $shipments;

    /** Available Balance. */
    public ?float $available_balance;

    /** NSU Processadora. */
    public ?string $nsu_processadora;

    /** Authentication Code. */
    public ?string $authentication_code;

    private $map = [
      "payer" => "MercadoPago\Resources\Payment\AdditionalInfoPayer",
      "shipments" => "MercadoPago\Resources\Payment\Shipments",
      "items" => "MercadoPago\Resources\Preference\Item",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
