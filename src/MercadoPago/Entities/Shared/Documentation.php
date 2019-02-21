<?php
namespace MercadoPago;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\DenyDynamicAttribute;

/**
 * Payer Class Doc Comment
 *
 * @package MercadoPago
 */
class Documentation extends Entity
{
    /**
    * @Attribute()
    */
    protected $type;
    /**
    * @Attribute(type = "string", readOnly = true)
    */
    protected $url;
    /**
    * @Attribute(type = "string", readOnly = true)
    */
    protected $description;
    /**
    * @Attribute(type = "string", readOnly = true)
    */

}

?>
