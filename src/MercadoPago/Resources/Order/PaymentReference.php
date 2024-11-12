<?php

/** Swagger version: 54cea3ac-c258-4a6f-aea9-988e641cff30 */

namespace MercadoPago\Resources\Order;

/** PaymentReference class. */
class PaymentReference
{
    /** Reference ID. */
    public ?string $id;

    /** Source. */
    public ?string $source;

    /** Metadata. */
    public array|object|null $metadata;
}
