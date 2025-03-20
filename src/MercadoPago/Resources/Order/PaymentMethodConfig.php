<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

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
