<?php

namespace MercadoPago\Client\Order\Transaction;

use MercadoPago\Serialization\Mapper;

/** PaymentsRequest class. */
class PaymentsRequest
{
    /** Class mapper. */
    use Mapper;

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
