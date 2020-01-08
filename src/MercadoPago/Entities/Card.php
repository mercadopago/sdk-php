<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/customers/:customer_id/cards", method="create")
 * @RestMethod(resource="/v1/customers/:customer_id/cards/:id", method="read")
 * @RestMethod(resource="/v1/customers/:customer_id/cards/:id", method="update")
 * @RestMethod(resource="/v1/customers/:customer_id/cards/:id", method="delete")
 * @RequestParam(param="access_token")
 */

class Card extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     */
    protected $id;

    /**
     * @Attribute(required = true)
     */
    protected $customer_id;
    /**
     * @Attribute()
     */
    protected $expiration_month;
    /**
     * @Attribute()
     */
    protected $expiration_year;
    /**
     * @Attribute()
     */
    protected $first_six_digits;
    /**
     * @Attribute()
     */
    protected $last_four_digits;
    /**
     * @Attribute()
     */
    protected $payment_method;
    /**
     * @Attribute()
     */
    protected $security_code;
    /**
     * @Attribute()
     */
    protected $issuer;
    /**
     * @Attribute()
     */
    protected $cardholder;
    /**
     * @Attribute()
     */
    protected $date_created;
    /**
     * @Attribute()
     */
    protected $date_last_updated;


}