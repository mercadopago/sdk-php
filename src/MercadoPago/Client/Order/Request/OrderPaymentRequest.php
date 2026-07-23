<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for a payment.
 *
 * Serializes to an entry of the `payments` array nested under `transactions`.
 * Null fields are omitted and nested objects (payment_method, automatic_payments,
 * stored_credential, subscription_data) are converted recursively
 * (see {@see self::toArray()}).
 */
final class OrderPaymentRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $amount = null,
        public readonly ?string $expiration_time = null,
        public readonly ?string $date_of_expiration = null,
        public readonly ?OrderPaymentMethodRequest $payment_method = null,
        public readonly ?OrderAutomaticPaymentsRequest $automatic_payments = null,
        public readonly ?OrderStoredCredentialRequest $stored_credential = null,
        public readonly ?OrderSubscriptionDataRequest $subscription_data = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "amount" => $this->amount,
            "expiration_time" => $this->expiration_time,
            "date_of_expiration" => $this->date_of_expiration,
            "payment_method" => $this->payment_method?->toArray(),
            "automatic_payments" => $this->automatic_payments?->toArray(),
            "stored_credential" => $this->stored_credential?->toArray(),
            "subscription_data" => $this->subscription_data?->toArray(),
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
