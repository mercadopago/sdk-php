<?php
namespace MercadoPago;

use MercadoPago\Annotation\Attribute;

/**
 * Tack class
 *
 * @package MercadoPago
 */
class Track extends Entity
{
    /**
     * @Attribute(type = "string")
     */
    protected $type;
    /**
     * @Attribute(type = "object")
     */
    protected $value;
}