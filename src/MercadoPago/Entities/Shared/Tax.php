<?php
namespace MercadoPago;

use MercadoPago\Annotation\Attribute;

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
