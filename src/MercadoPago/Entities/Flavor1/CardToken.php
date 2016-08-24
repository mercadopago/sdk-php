<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/card_tokens?public_key=:public_key", method="create")
 * @RestMethod(resource="/v1/card_tokens?public_key=:public_key", method="read")
 * @RestMethod(resource="/v1/card_tokens?public_key=:public_key", method="update")
 */

class CardToken extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     */
    protected $card_id;

    /**
     * @Attribute()
     */
    protected $public_key;
    /**
     * @Attribute()
     */
    protected $first_six_digits;
    /**
     * @Attribute()
     */
    protected $luhn_validation;
    /**
     * @Attribute()
     */
    protected $date_used;
    /**
     * @Attribute()
     */
    protected $status;
    /**
     * @Attribute()
     */
    protected $date_due;
    /**
     * @Attribute()
     */
    protected $card_number_length;
    /**
     * @Attribute()
     */
    protected $id;
    /**
     * @Attribute()
     */
    protected $security_code_length;
    /**
     * @Attribute()
     */
    protected $expiration_year;
    /**
     * @Attribute()
     */
    protected $expiration_month;
    /**
     * @Attribute()
     */
    protected $date_last_updated;
    /**
     * @Attribute()
     */
    protected $last_four_digits;
    /**
     * @Attribute()
     */
    protected $cardholder;
    /**
     * @Attribute()
     */
    protected $date_created;


}