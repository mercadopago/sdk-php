<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

namespace MercadoPago\Client\Order\Transaction;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** UpdateTransactionResponse class. */
class UpdateTransactionResponse extends MPResource
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
        "payment_method" => "MercadoPago\Client\Order\Transaction\PaymentMethodRequest",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
