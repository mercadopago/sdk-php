<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** PaymentMethod class. */
class PaymentMethod
{
    /** Class mapper. */
    use Mapper;

    /** Payment data. */
    public array|object|null $data;

    /** ID. */
    public ?string $id;

    /** Type. */
    public ?string $type;

    /** Issuer ID. */
    public ?string $issuer_id;

    private $map = [
        "data" => "MercadoPago\Resources\Payment\PaymentMethodData",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
