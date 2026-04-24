<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents business rules (discounts, fines, interest) applied to a payment method.
 *
 * Configures early-payment discounts, late-payment fines, and interest charges
 * for offline payment methods like boleto. Nested within {@see PaymentMethodData}.
 */
class PaymentMethodRules
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var PaymentDiscounts[]|null Early-payment discount rules. */
    public ?array $discounts;

    /** @var PaymentFee|array|null Late-payment fine configuration. */
    public array|object|null $fine;

    /** @var PaymentFee|array|null Interest charge configuration for overdue payments. */
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
