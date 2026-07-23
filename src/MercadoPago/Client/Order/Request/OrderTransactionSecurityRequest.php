<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for transaction security.
 *
 * Serializes to the `transaction_security` object nested under `config.online`
 * (NOT at the order root). Null fields are omitted (see {@see self::toArray()}).
 */
final class OrderTransactionSecurityRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $validation = null,
        public readonly ?string $liability_shift = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "validation" => $this->validation,
            "liability_shift" => $this->liability_shift,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
