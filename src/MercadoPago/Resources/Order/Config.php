<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the configuration settings for a MercadoPago order.
 *
 * Groups payment method restrictions/defaults and online checkout behavior
 * such as redirect URLs and differential pricing.
 *
 * @see \MercadoPago\Resources\Order
 */
class Config
{
    /** Class mapper. */
    use Mapper;

    /** Payment method restrictions, defaults, and installment settings. Maps to {@see PaymentMethodConfig}. */
    public array|object|null $payment_method;

    /** Online checkout configuration (redirect URLs, security). Maps to {@see OnlineConfig}. */
    public array|object|null $online;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethodConfig",
        "online" => "MercadoPago\Resources\Order\OnlineConfig",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
