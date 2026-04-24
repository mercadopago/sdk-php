<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents additional information attached to a payment in the MercadoPago API.
 *
 * Provides supplementary data about the transaction including item details,
 * payer information, and shipment data. Improving fraud prevention by sending
 * accurate additional info is recommended by MercadoPago.
 *
 * @see \MercadoPago\Resources\Payment
 */
class AdditionalInfo
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** IP address of the buyer (required for bank transfer payments). */
    public ?string $ip_address;

    /** Tracking identifier for the payment flow. */
    public ?string $tracking_id;

    /** @var \MercadoPago\Resources\Preference\Item[]|null List of items being purchased in this payment. */
    public ?array $items;

    /** @var AdditionalInfoPayer|array|null Extended payer details (name, phone, address, registration date). */
    public array|object|null $payer;

    /** @var Shipments|array|null Shipping details including receiver address. */
    public array|object|null $shipments;

    /** Available balance in the payer's MercadoPago account at the time of payment. */
    public ?float $available_balance;

    /** Unique Sequential Number assigned by the payment processor. */
    public ?string $nsu_processadora;

    /** Authentication code returned by the payment processor. */
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
