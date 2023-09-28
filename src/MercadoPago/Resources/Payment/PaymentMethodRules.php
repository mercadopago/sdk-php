<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** PaymentMethod class. */
class PaymentMethodRules
{
    /** Class mapper. */
    use Mapper;

    /** Payment discounts. */
    public ?array $discounts;

    /** Payment fine. */
    public array|object|null $fine;

    /** Payment interest. */
    public array|object|null $interest;

    private $map = [
        "discounts" => "MercadoPago\Resources\Payment\PaymentDiscounts",
        "fine" => "MercadoPago\Resources\Payment\PaymentFee",
        "interest" => "MercadoPago\Resources\Payment\PaymentFee",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
