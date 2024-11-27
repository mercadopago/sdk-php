<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

namespace MercadoPago\Resources\Order\Transaction;

/** PaymentMethod class. */
class PaymentMethod
{
    /** Payment method ID. */
    public ?string $id;

    /** Payment method type. */
    public ?string $type;

    /** Token. */
    public ?string $token;

    /** Installments. */
    public ?int $installments;

    /** Statement descriptor. */
    public ?string $statement_descriptor;
}
