<?php

namespace MercadoPago\Resources\Invoice;

/**
 * Invoice Payment resource.
 *
 * Represents the payment resulting from a subscription invoice charge attempt.
 * Contains the payment ID, its processing status, and a detailed status reason.
 */
class Payment
{
    /** The ID of the payment. */
    public ?int $id;

    /** Status of the invoice. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;
}
