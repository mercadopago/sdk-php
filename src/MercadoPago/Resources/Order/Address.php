<?php

/** API version: 54cea3ac-c258-4a6f-aea9-988e641cff30 */

namespace MercadoPago\Resources\Order;

/** Address class. */
class Address
{
    /** ZIP code. */
    public ?string $zip_code;

    /** Street name. */
    public ?string $street_name;

    /** Street number. */
    public ?string $street_number;
}
