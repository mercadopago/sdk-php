<?php

namespace MercadoPago\Entities;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/payments/:payment_id/refunds", method="create")
 * @RestMethod(resource="/v1/payments/:payment_id/refunds/:id", method="read")
 * @RequestParam(param="access_token")
 */
class Shipments extends Entity {

    /**
     * @Attribute()
     */
    protected $mode;
    /**
     * @Attribute()
     */
    protected $local_pickup;
    /**
     * @Attribute()
     */
    protected $free_methods;
    /**
     * @Attribute()
     */
    protected $cost;
    /**
     * @Attribute()
     */
    protected $free_shipping;
    /**
     * @Attribute()
     */
    protected $receiver_address;
    /**
     * @Attribute()
     */
    protected $dimensions;
    /**
     * @Attribute()
     */
    protected $default_shipping_method;
    

}


?>