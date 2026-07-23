<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for the order config.
 *
 * Serializes to the `config` object at the order root. The `payment_method` and
 * `online` config blocks are accepted as free-form arrays (matching the dynamic
 * request shape). When a typed {@see OrderTransactionSecurityRequest} is provided,
 * it is nested under `config.online.transaction_security` per the canonical model.
 * Null/empty fields are omitted (see {@see self::toArray()}).
 */
final class OrderConfigRequest implements JsonSerializable
{
    /**
     * @param array<string,mixed>|null $payment_method Free-form payment_method config block.
     * @param array<string,mixed>|null $online Free-form online config block.
     */
    public function __construct(
        public readonly ?string $notification_url = null,
        public readonly ?string $statement_descriptor = null,
        public readonly ?string $default_payment_due_date = null,
        public readonly ?array $payment_method = null,
        public readonly ?array $online = null,
        public readonly ?OrderTransactionSecurityRequest $transaction_security = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        $online = $this->online;
        if ($this->transaction_security !== null) {
            $online = ($online ?? []) + ["transaction_security" => $this->transaction_security->toArray()];
        }

        return array_filter([
            "notification_url" => $this->notification_url,
            "statement_descriptor" => $this->statement_descriptor,
            "default_payment_due_date" => $this->default_payment_due_date,
            "payment_method" => $this->payment_method,
            "online" => $online,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
