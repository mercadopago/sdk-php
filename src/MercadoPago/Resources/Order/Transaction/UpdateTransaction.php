<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

namespace MercadoPago\Resources\Order\Transaction;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** UpdateTransaction class. */
class UpdateTransaction extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Transaction ID. */
    public ?string $id;

    /** Amount. */
    public ?string $amount;

    /** Payment method. */
    public array|object|null $payment_method;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\Transaction\PaymentMethod",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
