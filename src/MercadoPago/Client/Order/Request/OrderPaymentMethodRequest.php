<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for a payment method.
 *
 * Serializes to the `payment_method` object nested under a payment. The `token`
 * is treated as an opaque string and is never transformed. Null fields are omitted
 * from the resulting array (see {@see self::toArray()}).
 */
final class OrderPaymentMethodRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $id = null,
        public readonly ?string $type = null,
        public readonly ?string $token = null,
        public readonly ?string $statement_descriptor = null,
        public readonly ?int $installments = null,
        public readonly ?string $financial_institution = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "id" => $this->id,
            "type" => $this->type,
            "token" => $this->token,
            "statement_descriptor" => $this->statement_descriptor,
            "installments" => $this->installments,
            "financial_institution" => $this->financial_institution,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
