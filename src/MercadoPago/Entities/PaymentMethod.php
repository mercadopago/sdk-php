<?php
namespace MercadoPago\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MercadoPago\Annotations as DataSource;
//use DrestCommon\Request\Request;
/**
 * MercadoPago\Entities\PaymentMethod
 *
 * @ORM\Table(name="payment_methods")
 * @ORM\Entity
 * @DataSource\Fetch("/v1/payment_methods")
 */
class PaymentMethod
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

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getName() {
        return $this->name;
    }
}