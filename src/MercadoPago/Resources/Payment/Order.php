<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Order class. */
class Order
{
    /** Class mapper. */
    use Mapper;

    public ?string $id;

    /** Item name.*/
    public ?string $type;

}
