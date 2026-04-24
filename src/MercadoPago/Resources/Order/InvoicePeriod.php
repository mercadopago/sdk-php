<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/**
 * Represents the billing period for a subscription invoice within an order.
 *
 * Defines the frequency and type of billing cycle used in recurring payment scenarios.
 *
 * @see \MercadoPago\Resources\Order\SubscriptionData
 */
class InvoicePeriod
{
    /** Number of units in the billing cycle (e.g., 1 for monthly, 7 for weekly). */
    public ?int  $period;

    /** Unit type of the billing period (e.g., "monthly", "daily"). */
    public ?string $type;
}
