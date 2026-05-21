<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents the result of listing available payment methods from the MercadoPago API.
 *
 * Wraps the array of payment method definitions returned by
 * {@see \MercadoPago\Client\PaymentMethod\PaymentMethodClient::list()}.
 */
class PaymentMethodResult extends MPResource
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var PaymentMethodListResult[]|array|null List of available payment methods for the account. */
    public array|object|null $data;

    private $map = [
        "data" => "MercadoPago\Resources\PaymentMethod\PaymentMethodListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
