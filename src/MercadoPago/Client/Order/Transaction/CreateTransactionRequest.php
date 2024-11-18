<?php

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
