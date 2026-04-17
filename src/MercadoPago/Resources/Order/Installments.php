<?php

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Installments class. */
class Installments
{
    /** Class mapper. */
    use Mapper;

    /** Interest-free installment configuration. */
    public array|object|null $interest_free = null;

    /** Available installment configuration. */
    public array|object|null $available = null;

    private $map = [
        "interest_free" => "MercadoPago\Resources\Order\InstallmentsInterestFree",
        "available" => "MercadoPago\Resources\Order\InstallmentsAvailable",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
