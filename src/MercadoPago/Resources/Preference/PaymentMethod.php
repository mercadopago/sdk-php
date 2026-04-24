<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Excluded Payment Method resource.
 *
 * Identifies a specific payment method to exclude from the checkout preference.
 * Used within {@see \MercadoPago\Resources\Preference\PaymentMethods} to restrict
 * which payment methods are available to the buyer.
 */
class PaymentMethod
{
    /** Payment method ID. */
    public ?string $id;
}
