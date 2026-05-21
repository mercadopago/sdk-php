<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Represents the result of listing all refunds for a given payment.
 *
 * Wraps an array of {@see \MercadoPago\Resources\Payment\PaymentRefundListResult} items.
 * Returned by {@see \MercadoPago\Client\Payment\PaymentRefundClient::list()}.
 */
class PaymentRefundResult extends MPResource
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** @var PaymentRefundListResult[]|array|null List of refunds associated with the payment. */
    public array|object|null $data;

    private $map = [
        "data" => "MercadoPago\Resources\Payment\PaymentRefundListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
