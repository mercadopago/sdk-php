<?php
namespace MercadoPago\Entities\Shared;

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