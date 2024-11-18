<?php

namespace MercadoPago\Client\Order\Transaction;

/** PaymentMethodRequest class. */
class PaymentMethodRequest
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
