<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** Payer class. */
class Payer
{
    /** Payer's identification type (mandatory if the payer is a Customer). */
    public $type;

    /** Payer's ID. */
    public $id;

    /** Email of the payer. */
    public $email;

    /** Payer's personal identification. */
    public $identification;

    /** Payer's first name. */
    public $first_name;

    /** Payer's last name. */
    public $last_name;

    /** Payer's entity type (only for bank transfers). */
    public $entity_type;

    /** Class mapper. */
    use Mapper;

    private $map = [
        "identification" => "MercadoPago\Resources\Payment\Identification",
        "phone" => "MercadoPago\Resources\Payment\Phone"
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap()
    {
        return $this->map;
    }
}
