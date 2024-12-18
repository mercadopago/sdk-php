<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

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
