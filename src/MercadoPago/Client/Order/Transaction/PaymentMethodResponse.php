<?php

namespace MercadoPago\Client\Order\Transaction;

/** PaymentMethodResponse class. */
class PaymentMethodResponse
{
    /** Payment method ID. */
    public ?string $id;

    /** Payment method type. */
    public ?string $type;

    /** Installments. */
    public ?int $installments;

    /** Statement descriptor. */
    public ?string $statement_descriptor;
}
