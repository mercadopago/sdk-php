<?php

namespace MercadoPago\Resources\Preference;

/**
 * Preference Tax resource.
 *
 * Represents a tax applied to a checkout preference. Each tax entry specifies
 * a tax type (e.g. "IVA", "ISC") and its corresponding monetary value.
 */
class Tax
{
    /** Tax type. */
    public ?string $type;

    /** Tax value. */
    public ?float $value;
}
