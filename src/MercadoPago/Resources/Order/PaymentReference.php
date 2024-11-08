<?php

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
