<?php

namespace MercadoPago\Resources\Order;

/**
 * Represents a discount applied to an individual payment within an order.
 *
 * Tracks the type of discount (e.g., campaign, coupon) that reduced the
 * effective amount charged on a specific payment.
 *
 * @see \MercadoPago\Resources\Order\Payment
 */
class PaymentDiscount
{
    /** Discount classification (e.g., "campaign", "coupon"). */
    public ?string $type = null;
}
