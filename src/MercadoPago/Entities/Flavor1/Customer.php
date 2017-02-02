<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/customers/:id", method="read")
 * @RestMethod(resource="/v1/customers/search", method="search")
 * @RestMethod(resource="/v1/customers/", method="create")
 * @RestMethod(resource="/v1/customers/:id", method="update")
 * @RestMethod(resource="/v1/customers/:id", method="remove")
 * @RequestParam(param="access_token")
 */

class Customer extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     */
    protected $email;

    /**
     * @Attribute()
     */
    protected $id;
    /**
     * @Attribute()
     */
    protected $first_name;
    /**
     * @Attribute()
     */
    protected $last_name;
    /**
     * @Attribute()
     */
    protected $phone;
    /**
     * @Attribute()
     */
    protected $identification;
    /**
     * @Attribute()
     */
    protected $default_address;
    /**
     * @Attribute()
     */
    protected $address;
    /**
     * @Attribute()
     */
    protected $date_registered;
    /**
     * @Attribute()
     */
    protected $description;
    /**
     * @Attribute()
     */
    protected $date_created;
    /**
     * @Attribute()
     */
    protected $date_last_updated;
    /**
     * @Attribute()
     */
    protected $metadata;
    /**
     * @Attribute()
     */
    protected $default_card;
    /**
     * @Attribute()
     */
    protected $cards;
    /**
     * @Attribute()
     */
    protected $addresses;


}