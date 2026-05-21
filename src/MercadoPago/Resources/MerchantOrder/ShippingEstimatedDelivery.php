<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Shipping Estimated Delivery resource.
 *
 * Represents the estimated delivery window for a shipping option, including
 * the expected delivery date and the time range within that day.
 */
class ShippingEstimatedDelivery
{
    /** Estimated delivery date. */
    public ?string $date;

    /** Estimated lower delivery time. */
    public ?string $time_from;

    /** Estimated upper delivery time. */
    public ?string $time_to;
}
