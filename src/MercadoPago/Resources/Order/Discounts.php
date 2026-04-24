<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents discount rules applied to a MercadoPago order.
 *
 * Discounts are organized by payment method, allowing different discount
 * amounts depending on how the buyer pays.
 *
 * @see \MercadoPago\Resources\Order
 */
class Discounts
{
    /** Class mapper. */
    use Mapper;

    /** Discount definitions per payment method type. Each element maps to {@see PaymentMethodDiscount}. */
    public ?array $payment_methods;

    private $map = [
        "payment_methods" => "MercadoPago\Resources\Order\PaymentMethodDiscount",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
