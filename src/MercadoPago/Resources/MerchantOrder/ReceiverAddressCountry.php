<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Receiver Address Country resource.
 *
 * Represents the country component of a shipment's receiver address within a merchant order.
 */
class ReceiverAddressCountry
{
    /** Country ID. */
    public ?string $id;

    /** Country name. */
    public ?string $name;
}
