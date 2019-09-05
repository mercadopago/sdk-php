<?php
namespace MercadoPago;

use http\Params;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/discount_campaigns", method="read")
 * @RequestParam(param="access_token")
 */


class DiscountCampaign extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     */
    protected $id;

    /**
     * @Attribute()
     */
    protected $name;

    /**
     * @Attribute()
     */
    protected $percent_off;

    /**
     * @Attribute()
     */
    protected $amount_off;

    /**
     * @Attribute()
     */
    protected $coupon_amount;

    /**
     * @Attribute()
     */
    protected $currency_id;

    /**
     * @return mixed
     */
    public static function read($options = [], $params = []){
        return parent::read([], $options);
    }
}
