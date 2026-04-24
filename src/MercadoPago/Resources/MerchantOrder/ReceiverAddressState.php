<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Receiver Address State resource.
 *
 * Represents the state/province component of a shipment's receiver address within a merchant order.
 */
class ReceiverAddressState
{
    /** State ID. */
    public ?string $id;

    /** State name. */
    public ?string $name;
}
