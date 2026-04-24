<?php

namespace MercadoPago\Resources\Order;

/**
 * Represents a chargeback dispute within an order transaction.
 *
 * A chargeback occurs when a buyer disputes a charge with their card issuer.
 * This resource tracks the dispute lifecycle including its status and related references.
 *
 * @see \MercadoPago\Resources\Order\Transactions
 */
class Chargeback
{
    /** Unique identifier of the chargeback assigned by MercadoPago. */
    public ?string $id = null;

    /** Identifier of the original payment transaction that was disputed. */
    public ?string $transaction_id = null;

    /** Case identifier opened with the card network or issuing bank. */
    public ?string $case_id = null;

    /** Current status of the chargeback dispute (e.g., "opened", "closed"). */
    public ?string $status = null;

    /** External references or evidence associated with this chargeback. */
    public ?array $references = null;
}
