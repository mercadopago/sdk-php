<?php

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Payments class. */
class Payments
{
    /** Class mapper. */
    use Mapper;

    /** Payment ID. */
    public ?string $id;

    /** Amount. */
    public ?string $amount;

    /** Currency. */
    public ?string $currency;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /** Reference. */
    public array|object|null $reference;

    /** Payment method. */
    public array|object|null $payment_method;

    private $map = [
        "reference" => "MercadoPago\Resources\Order\PaymentReference",
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethod",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
