<?php

namespace MercadoPago\Client\Order\Transaction;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** TransactionResponse class. */
class TransactionResponse extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Payments. */
    public ?array $payments;

    private $map = [
        "payments" => "MercadoPago\Client\Order\Transaction\PaymentsResponse",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
