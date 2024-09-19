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

    public array|object|null $business_info;

    public array|object|null $location;

    public ?string $release_info;

    private $map = [
        "application_data" => "MercadoPago\Resources\Payment\ApplicationData",
        "transaction_data" => "MercadoPago\Resources\Payment\TransactionData",
        "business_info" => "MercadoPago\Resources\Common\BussinessInfo",
        "location" => "MercadoPago\Resources\Common\Location",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
