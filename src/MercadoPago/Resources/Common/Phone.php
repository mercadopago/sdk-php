<?php

namespace MercadoPago\Resources\Common;

/**
 * Represents a phone number associated with a payer or contact in the MercadoPago API.
 *
 * Used as a nested DTO within payer and additional info structures
 * to capture contact telephone details.
 */
class Phone
{
    /** Country or regional area code (e.g. "11" for Sao Paulo). */
    public ?string $area_code;

    /** Phone number without area code. */
    public ?string $number;

    /** Phone extension number, if applicable. */
    public ?string $extension;
}
