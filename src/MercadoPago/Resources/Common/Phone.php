<?php

namespace MercadoPago\Resources\Common;

use JsonSerializable;

/**
 * Represents a phone number associated with a payer or contact in the MercadoPago API.
 *
 * Used as a nested DTO within payer and additional info structures to capture
 * contact telephone details. Also used as a typed request object when building
 * order or payment request bodies.
 */
class Phone implements JsonSerializable
{
    /** Country or regional area code (e.g. "11" for Sao Paulo). */
    public ?string $area_code;

    /** Phone number without area code. */
    public ?string $number;

    /** Phone extension number, if applicable. */
    public ?string $extension;

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "area_code" => $this->area_code,
            "number" => $this->number,
            "extension" => $this->extension,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
