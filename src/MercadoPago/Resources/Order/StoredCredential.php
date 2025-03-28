<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/** StoredCredential class. */
class StoredCredential
{
    /** Payment initiator. */
    public ?string $payment_initiator;

    /** Reason. */
    public ?string $reason;

    /** Store payment method. */
    public ?bool $store_payment_method;

    /** First payment. */
    public ?bool $first_payment;
}
