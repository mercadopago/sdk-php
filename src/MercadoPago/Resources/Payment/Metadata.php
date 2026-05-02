<?php

namespace MercadoPago\Resources\Payment;

/** Metadata class. */
class Metadata
{
    /** Order number. */
    public ?string $order_number;

    /** User type. **/
    public ?string $user_type;

    /** Preapproval ID. **/
    public ?string $preapproval_id;

    /** Available tries **/
    public ?int $available_tries;
}
