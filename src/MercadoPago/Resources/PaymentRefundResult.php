<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Payment Refund Result class. */
class PaymentRefundResult extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Data. */
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
