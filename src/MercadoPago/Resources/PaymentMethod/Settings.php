<?php

namespace MercadoPago\Resources\PaymentMethod;

use MercadoPago\Serialization\Mapper;

/**
 * Payment Method Settings resource.
 *
 * Groups the card validation settings for a payment method, including BIN patterns,
 * card number length/validation rules, and security code requirements.
 *
 * Fields are mapped to nested DTOs:
 * - bin -> {@see \MercadoPago\Resources\PaymentMethod\Bin}
 * - card_number -> {@see \MercadoPago\Resources\PaymentMethod\CardNumber}
 * - security_code -> {@see \MercadoPago\Resources\PaymentMethod\SecurityCode}
 */
class Settings
{
    /** Class mapper. */
    use Mapper;

    /** Setting bin. */
    public array|object|null $bin;

    /** Setting card number. */
    public array|object|null $card_number;

    /** Setting security code. */
    public array|object|null $security_code;

    private $map = [
        "bin" => "MercadoPago\Resources\PaymentMethod\Bin",
        "card_number" => "MercadoPago\Resources\PaymentMethod\CardNumber",
        "security_code" => "MercadoPago\Resources\PaymentMethod\SecurityCode",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
