<?php

/** API version: 950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

/** Address class. */
class Address
{
    /** Street name. */
    public ?string $street_name;

    /** Street number. */
    public ?string $street_number;

    /** Zip Code. */
    public ?string $zip_code;
}
