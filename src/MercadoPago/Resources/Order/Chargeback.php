<?php

namespace MercadoPago\Resources\Order;

/** Chargeback class. */
class Chargeback
{
    /** Chargeback unique identifier. */
    public ?string $id = null;

    /** Transaction ID originating the chargeback. */
    public ?string $transaction_id = null;

    /** Case ID opened with the card operator. */
    public ?string $case_id = null;

    /** Current chargeback status. */
    public ?string $status = null;

    /** List of references related to the chargeback. */
    public ?array $references = null;
}
