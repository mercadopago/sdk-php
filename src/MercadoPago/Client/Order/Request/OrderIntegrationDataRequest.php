<?php

namespace MercadoPago\Client\Order\Request;

use JsonSerializable;

/**
 * Typed request object for integration data.
 *
 * Serializes to the `integration_data` object at the order root. Null fields are
 * omitted and the nested sponsor is converted recursively (see {@see self::toArray()}).
 */
final class OrderIntegrationDataRequest implements JsonSerializable
{
    public function __construct(
        public readonly ?string $integrator_id = null,
        public readonly ?string $platform_id = null,
        public readonly ?string $corporation_id = null,
        public readonly ?OrderSponsorRequest $sponsor = null,
    ) {
    }

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "integrator_id" => $this->integrator_id,
            "platform_id" => $this->platform_id,
            "corporation_id" => $this->corporation_id,
            "sponsor" => $this->sponsor?->toArray(),
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
