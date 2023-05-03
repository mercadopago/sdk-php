<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** PointOfInteraction class. */
class PointOfInteraction
{
    /** Class mapper. */
    use Mapper;

    /** Type. */
    public $type;

    /** Sub type. */
    public $sub_type;

    /** Application data. */
    public $application_data;

    /** Transaction data. */
    public $transaction_data;

    /** Business info. */
    public $business_info;

    /** Location. */
    public $location;

    private $map = [
        "application_data" => "MercadoPago\Resources\Payment\ApplicationData",
        "transaction_data" => "MercadoPago\Resources\Payment\TransactionData",
        "business_info" => "MercadoPago\Resources\Payment\BusinessInfo",
        "location" => "MercadoPago\Resources\Payment\Location",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
