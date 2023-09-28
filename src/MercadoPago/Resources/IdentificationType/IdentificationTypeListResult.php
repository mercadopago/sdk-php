<?php

namespace MercadoPago\Resources\IdentificationType;

/** IdentificationTypeListResult class. */
class IdentificationTypeListResult
{
    /** Identification type ID. */
    public ?string $id;

    /** Identification type name. */
    public ?string $name;

    /** Identification type type. */
    public ?string $type;

    /** Identification type min length. */
    public ?int $min_length;

    /** Identification type max length. */
    public ?int $max_length;
}
