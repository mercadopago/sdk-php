<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for the order transactions.
 *
 * Serializes to the `transactions` object at the order root. Null fields are omitted
 * and each payment in `payments` is converted recursively (see {@see self::toArray()}).
 */
final class OrderTransactionRequest implements JsonSerializable
{
    /**
     * @param array<int,OrderPaymentRequest>|null $payments List of typed payment requests.
     */
    public function __construct(
        public readonly ?array $payments = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "payments" => $this->payments === null
                ? null
                : array_map(fn (OrderPaymentRequest $p) => $p->toArray(), $this->payments),
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
