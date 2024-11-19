<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

namespace MercadoPago\Client\Order\Transaction;

use MercadoPago\Serialization\Mapper;

/** CreateTransactionRequest class. */
class CreateTransactionRequest
{
    /** Class mapper. */
    use Mapper;

    /** Payments. */
    public ?array $payments;

    private $map = [
        "payments" => "MercadoPago\Client\Order\Transaction\PaymentsRequest",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
