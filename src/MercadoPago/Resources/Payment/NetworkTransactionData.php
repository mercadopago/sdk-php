<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents card network transaction identifiers in the MercadoPago API.
 *
 * Contains the network transaction ID assigned by the card scheme (Visa, Mastercard, etc.)
 * which is required for Merchant-Initiated Transactions (MIT) and recurring payment flows.
 * Nested within {@see ForwardData}.
 */
class NetworkTransactionData
{
    /** Unique transaction identifier assigned by the card network for traceability. */
    public ?string $network_transaction_id;
}
