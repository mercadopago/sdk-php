<?php

namespace MercadoPago\Resources\Common;

use JsonSerializable;

/**
 * Represents a personal or legal identification document in the MercadoPago API.
 *
 * Used to identify payers, cardholders, and sub-merchants through government-issued
 * documents such as CPF, CNPJ, DNI, or similar national IDs. Also used as a typed
 * request object when building order or payment request bodies.
 */
class Identification implements JsonSerializable
{
    /** Document type code (e.g. "CPF", "CNPJ", "DNI", "CC"). */
    public ?string $type;

    /** Document number corresponding to the identification type. */
    public ?string $number;

    /** @return array<string,mixed> */
    public function toArray(): array
    {
        return array_filter([
            "type" => $this->type,
            "number" => $this->number,
        ], fn ($v) => $v !== null);
    }

    /** @return array<string,mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
