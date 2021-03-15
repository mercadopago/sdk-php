<?php
namespace MercadoPago\Entities\Shared;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Entity;

/**
 * Payer Class Doc Comment
 *
 * @package MercadoPago
 */
class Tax extends Entity
{
    /**
     * @Attribute(type = "string")
     */
    protected $type;
    /**
     * @Attribute(type = "float")
     */
    protected $value;
}
