<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Receiver Address City resource.
 *
 * Represents the city component of a shipment's receiver address within a merchant order.
 */
class ReceiverAddressCity
{
    /** City ID. */
    public ?string $id;

    /** City name. */
    public ?string $name;
}
