<?php

namespace MercadoPago\Resources\MerchantOrder;

use MercadoPago\Serialization\Mapper;

class Shipment
{
    /** Class mapper. */
    use Mapper;

    /** Shipping ID. */
    public ?int $id;

    /** Shipping type. */
    public ?string $shipping_type;

    /** Shipping mode. */
    public ?string $shipping_mode;

    /** Shipping picking type. */
    public ?string $picking_type;

    /** Shipping status. */
    public ?string $status;

    /** Shipping sub status. */
    public ?string $shipping_substatus;

    /** Shipping items. */
    public ?array $items;

    /** Date of creation. */
    public ?string $date_created;

    /** Last modified date. */
    public ?string $last_modified;

    /** First printed date. */
    public ?string $date_first_printed;

    /** Shipping service ID. */
    public ?string $service_id;

    /** Sender ID. */
    public ?int $sender_id;

    /** Receiver ID. */
    public ?int $receiver_id;

    /** Shipping address. */
    public array|object|null $receiver_address;

    /** Shipping options. */
    public array|object|null $shipping_option;

    private $map = [
      "receiver_address" => "MercadoPago\Resources\MerchantOrder\ReceiverAddress",
      "shipping_option" => "MercadoPago\Resources\MerchantOrder\ShippingOption",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
