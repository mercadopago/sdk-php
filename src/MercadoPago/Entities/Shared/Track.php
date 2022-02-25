<?php
/**
 * Track class file
 */
namespace MercadoPago\Entities\Shared;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Entity;

/**
 * Track class
 */
class Track extends Entity
{
    /**
     * type
     * @Attribute(type = "string")
     * @var string
     */
    protected $type;

    /**
     * value
     * @Attribute(type = "object")
     * @var object
     */
    protected $value;
}