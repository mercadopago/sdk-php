<?php
/**
 * Tax class file
 */
namespace MercadoPago\Entities\Shared;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Entity;

/**
 * Tax class
 */
class Tax extends Entity
{
    /**
     * type
     * @Attribute(type = "string")
     * @var string
     */
    protected $type;

    /**
     * value
     * @Attribute(type = "float")
     * @var float
     */
    protected $value;
}
