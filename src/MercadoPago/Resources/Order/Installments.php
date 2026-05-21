<?php

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents installment plan configuration for an order's payment method.
 *
 * Groups both interest-free promotions and general installment availability
 * settings that determine how payments can be split.
 *
 * @see \MercadoPago\Resources\Order\PaymentMethodConfig
 */
class Installments
{
    /** Class mapper. */
    use Mapper;

    /** Interest-free installment promotion rules. Maps to {@see InstallmentsInterestFree}. */
    public array|object|null $interest_free = null;

    /** General installment availability settings. Maps to {@see InstallmentsAvailable}. */
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
