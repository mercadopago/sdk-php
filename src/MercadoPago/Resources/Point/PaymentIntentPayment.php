<?php

namespace MercadoPago\Resources\Point;

/**
 * Point Payment Intent Payment configuration resource.
 *
 * Defines the payment parameters for a Point payment intent, including the number
 * of installments, who bears the installment cost, and the payment type
 * (e.g. "credit_card", "debit_card").
 */
class PaymentIntentPayment
{
    /** Number of installments for the payment. */
    public ?int $installments;

    /** Cost of installments. */
    public ?string $installments_cost;

    /** Type of the payment. */
    public ?string $type;
}
