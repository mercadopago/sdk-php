<?php

namespace MercadoPago\Resources\Point;

/** PaymentIntentPayment class. */
class PaymentIntentPayment
{
    /** Payment ID. */
    public ?int $id;

    /** Number of installments for the payment. */
    public ?int $installments;

    /** Cost of installments. */
    public ?string $installments_cost;

    /** Type of the payment. */
    public ?string $type;
}
