<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents the reference data associated with a CREDENTIAL_ON_FILE transaction in the MercadoPago API.
 *
 * Contains identifiers that link the current transaction to a prior agreement or
 * stored credential. Nested within {@see TransactionData}.
 */
class TransactionDataReference
{
    /** Identifier of the original transaction used as the stored credential reference. */
    public ?string $id;
}
