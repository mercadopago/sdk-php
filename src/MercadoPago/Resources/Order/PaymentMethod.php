<?php

namespace MercadoPago\Resources\Order;

/** PaymentMethod class. */
class PaymentMethod
{
    /** Payment method ID. */
    public ?string $id;

    /** Payment method type. */
    public ?string $type;

    /** Token. */
    public ?string $token;

    /** Issuer ID. */
    public ?string $issuer_id;

    /** Statement descriptor. */
    public ?string $statement_descriptor;

    /** Installments. */
    public ?string $installments;
}
