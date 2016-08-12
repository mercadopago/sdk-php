<?php
namespace MercadoPago;

use MercadoPago;
use Doctrine\ORM\Mapping as ORM;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/dummies", method="list")
 * @RestMethod(resource="/dummy/:id", method="read")
 * @RestMethod(resource="/dummy/:id", method="update")
 * @RequestParam(param="access_token")
 */

class DummyEntity extends MercadoPago\Entity
{
    /**
     * @Attribute(primaryKey = true, type="integer")
     * @var
     */
    protected $id;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $title;
    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $desc;
    /**
     * @Attribute(type = "float")
     * @var
     */
    protected $price;
    /**
     * @Attribute(type = "int")
     * @var
     */
    protected $quantity;
    /**
     * @Attribute(type = "date")
     * @var
     */
    protected $registered_at;

    /**
     * @Attribute(type = "stdClass")
     * @var
     */
    protected $object;

    /**
     * @Attribute()
     * @var
     */
    protected $other;

}