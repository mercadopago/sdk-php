<?php

namespace MercadoPago\Resources\Customer;

/**
 * Represents the payment method (card brand/network) associated with a saved card.
 *
 * Provides the brand name, type classification, and logo URLs for display in
 * checkout UIs. Used as a nested object within {@see \MercadoPago\Resources\CustomerCard}
 * and {@see \MercadoPago\Resources\Customer\CustomerCardListResult}.
 */
class PaymentMethod
{
    /** Payment method identifier (e.g., "visa", "master", "amex"). */
    public ?string $id;

    /** Human-readable name of the payment method (e.g., "Visa", "Mastercard"). */
    public ?string $name;

    /** Payment type classification (e.g., "credit_card", "debit_card", "prepaid_card"). */
    public ?string $payment_type_id;

    /** URL to the payment method logo image (HTTP). */
    public ?string $thumbnail;

    /** URL to the payment method logo image over HTTPS. */
    public ?string $secure_thumbnail;
}
