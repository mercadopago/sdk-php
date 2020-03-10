<?php


namespace MercadoPago\Entities\Insight\DTO;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Entity;

class ClientInfo
{
    const SerialVersionUID = 1;

    /**
     * @Attribute(json = "name")
     */
    public $name;

    /**
     * @Attribute(json = "version")
     */
    public $version;


}