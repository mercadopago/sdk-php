<?php

namespace MercadoPago\Resources\Customer;

/** Payment Method class. */
class PaymentMethod
{
    /** Id of the payment method. */
    public ?string $id;

    /** Name of payment method. */
    public ?string $name;

    /** Type of payment method. */
    public ?string $payment_type_id;

    /** Thumbnail of payment method. */
    public ?string $thumbnail;

    /** Thumbnail of payment method from a secure source. */
    public ?string $secure_thumbnail;
}
