<?php

namespace MercadoPago\Client\Order\Request;

/**
 * Typed request object for automatic payments data.
 *
 * Serializes to the `automatic_payments` object nested under a payment.
 * Null fields are omitted from the resulting array (see {@see self::toArray()}).
 */
final class OrderAutomaticPaymentsRequest
{
    public function __construct(
        public readonly ?string $payment_profile_id = null,
        public readonly ?string $schedule_date = null,
        public readonly ?string $due_date = null,
        public readonly ?int $retries = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "payment_profile_id" => $this->payment_profile_id,
            "schedule_date" => $this->schedule_date,
            "due_date" => $this->due_date,
            "retries" => $this->retries,
        ], fn ($v) => $v !== null);
    }

}
