<?php

/** Swagger version: 54cea3ac-c258-4a6f-aea9-988e641cff30 */

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
