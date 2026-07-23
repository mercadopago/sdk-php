<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for stored credential (card-on-file) data.
 *
 * Serializes to the `stored_credential` object nested under a payment.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderStoredCredentialRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $payment_initiator = null,
        public readonly ?string $reason = null,
        public readonly ?bool $store_payment_method = null,
        public readonly ?bool $first_payment = null,
        public readonly ?string $prev_transaction_ref = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "payment_initiator" => $this->payment_initiator,
            "reason" => $this->reason,
            "store_payment_method" => $this->store_payment_method,
            "first_payment" => $this->first_payment,
            "prev_transaction_ref" => $this->prev_transaction_ref,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
