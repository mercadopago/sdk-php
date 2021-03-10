<?php
namespace MercadoPago\Entities\Shared;

use MercadoPago\Annotation\Attribute;
use MercadoPago\Annotation\DenyDynamicAttribute;

/**
 * Payer Class Doc Comment
 *
 * @package MercadoPago
 */
class Item extends Entity
{
    /**
     * @Attribute(type = "string")
     */
    protected $id;
    /**
     * @Attribute(type = "string")
     */
    protected $title;
    /**
     * @Attribute(type = "string")
     */
    protected $description;
    /**
     * @Attribute(type = "string")
     */
    protected $category_id;
    /**
     * @Attribute(type = "string")
     */
    protected $picture_url;
    /**
     * @Attribute(type = "string")
     */
    protected $currency_id;
    /**
     * @Attribute(type = "int")
     */
    protected $quantity;
    /**
     * @Attribute(type = "float")
     */
    protected $unit_price;

}