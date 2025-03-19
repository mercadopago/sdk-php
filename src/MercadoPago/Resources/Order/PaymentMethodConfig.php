<?php

/** API version: 950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

/** PaymentMethodConfig class. */
class PaymentMethodConfig
{
    /** Not allowed ids. */
    public ?array $not_allowed_ids;

    /** Not allowed types. */
    public ?array $not_allowed_types;

    /** Default ID. */
    public ?string $default_id;

    /** Max installments. */
    public ?int $max_installments;

    /** Default installments. */
    public ?int $default_installments;
}
