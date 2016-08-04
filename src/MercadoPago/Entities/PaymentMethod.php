<?php
namespace MercadoPago\Entities;

use Doctrine\ORM\Mapping as ORM;
use MercadoPago;
use MercadoPago\Annotation\RestMethod;

/**
 * @RestMethod(resource="/v1/payment_methods", method="list")
 */

class PaymentMethod extends MercadoPago\Entity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

}