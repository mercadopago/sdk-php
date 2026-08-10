<?php

namespace MercadoPago\Resources\Order;

/**
 * Represents general installment availability settings for a payment method.
 *
 * Defines which installment options are available to the buyer when paying
 * for an order.
 *
 * @see \MercadoPago\Resources\Order\Installments
 */
class InstallmentsAvailable
{
    /** Installment availability type (e.g., "buyer_costs" when the buyer absorbs interest). */
    public ?string $type = null;
}
