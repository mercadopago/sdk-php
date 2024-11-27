<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

namespace MercadoPago\Resources\Order;

/** Refund class. */
class Refund
{
    /** Refund ID. */
    public ?string $id;

    /** Transaction ID. */
    public ?string $transaction_id;

    /** Reference ID. */
    public ?string $reference_id;

    /** Amount. */
    public ?string $amount;

    /** Status. */
    public ?string $status;
}
