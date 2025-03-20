<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/** Automatic Payment Class */
class StoredCredential
{
    /** Payment profile id */
    public ?string $payment_initiator;

    /** Retries */
    public ?string $reason;

    /** Schedule Date */
    public ?bool $store_payment_method;

    /** Due Date */
    public ?bool $first_payment;
}
