<?php
namespace MercadoPago\Entities;

use MercadoPago;
use Doctrine\ORM\Mapping as ORM;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;

/**
 * @RestMethod(resource="/v1/payment_methods", method="list")
 * @RequestParam("access_token")
 */

class PaymentMethod extends MercadoPago\Entity
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $name;

}