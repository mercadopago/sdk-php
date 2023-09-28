<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** PointOfInteraction class. */
class PointOfInteraction
{
    /** Class mapper. */
    use Mapper;

    /** Type. */
    public ?string $type;

    /** Sub type. */
    public ?string $sub_type;

    /** Application data. */
    public array|object|null $application_data;

    /** Transaction data. */
    public array|object|null $transaction_data;

    private $map = [
        "application_data" => "MercadoPago\Resources\Payment\ApplicationData",
        "transaction_data" => "MercadoPago\Resources\Payment\TransactionData",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
