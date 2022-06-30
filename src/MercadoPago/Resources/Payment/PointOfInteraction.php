<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** PointOfInteraction class. */
class PointOfInteraction
{
    /** Type. */
    public $type;

    /** Sub type. */
    public $sub_type;

    /** Application data. */
    public $application_data;

    /** Transaction data. */
    public $transaction_data;

    /** Class mapper. */
    use Mapper;

    private $map = [
        "application_data" => "MercadoPago\Resources\Payment\ApplicationData",
        "transaction_data" => "MercadoPago\Resources\Payment\TransactionData",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap()
    {
        return $this->map;
    }
}
