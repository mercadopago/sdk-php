<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Excluded Payment Type resource.
 *
 * Identifies a payment type to exclude from the checkout preference (e.g. "ticket",
 * "credit_card"). Used within {@see \MercadoPago\Resources\Preference\PaymentMethods}
 * to restrict which payment type categories are available to the buyer.
 */
class PaymentType
{
    /** Payment type ID. */
    public ?string $id;
}
