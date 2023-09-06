<?php

namespace MercadoPago\Resources\Invoice;

/** Payment class. */
class Payment
{
    /** The ID of the payment. */
    public ?int $id;

    /** Status of the invoice. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;
}
