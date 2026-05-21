<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

/**
 * Represents a discount rule associated with a specific payment method type.
 *
 * Used within order-level discounts to offer reduced pricing when the buyer
 * pays with a particular payment method.
 *
 * @see \MercadoPago\Resources\Order\Discounts
 */
class PaymentMethodDiscount
{
    /** Payment method type this discount applies to (e.g., "credit_card", "debit_card"). */
    public ?string $type;

    /** Discounted total amount when this payment method is used. */
    public ?string $new_total_amount;
}
