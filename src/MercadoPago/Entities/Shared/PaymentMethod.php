<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/payment_methods", method="list")
 * @RequestParam(param="access_token")
 */

class PaymentMethod extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     * @var
     */
    protected $id;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $name;

}