<?php

namespace MercadoPago\Resources\Order;

/**
 * Represents interest-free installment promotion rules for a payment method.
 *
 * Defines promotional installment plans where the seller absorbs the interest cost,
 * allowing buyers to pay in installments without additional charges.
 *
 * @see \MercadoPago\Resources\Order\Installments
 */
class InstallmentsInterestFree
{
    /** Promotion type that determines who absorbs the interest cost (e.g., "seller_costs"). */
    public ?string $type = null;

    /** Allowed installment counts for this promotion (e.g., [3, 6, 12]). */
    public ?array $values = null;
}
