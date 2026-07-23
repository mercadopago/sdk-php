<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for the order payer.
 *
 * Serializes to the `payer` object at the order root. Null fields are omitted and
 * nested objects (identification, phone, address) are converted recursively
 * (see {@see self::toArray()}).
 */
final class OrderPayerRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $email = null,
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?string $customer_id = null,
        public readonly ?string $entity_type = null,
        public readonly ?OrderIdentificationRequest $identification = null,
        public readonly ?OrderPhoneRequest $phone = null,
        public readonly ?OrderAddressRequest $address = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "email" => $this->email,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "customer_id" => $this->customer_id,
            "entity_type" => $this->entity_type,
            "identification" => $this->identification?->toArray(),
            "phone" => $this->phone?->toArray(),
            "address" => $this->address?->toArray(),
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
