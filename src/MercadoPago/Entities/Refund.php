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
class Refund extends Entity {

    /**
     * @Attribute()
     */
    protected $id;
    /**
     * @Attribute(serialize=false)
     */
    protected $payment_id;
    /**
     * @Attribute()
     */
    protected $amount;
    /**
     * @Attribute()
     */
    protected $metadata;
    /**
     * @Attribute()
     */
    protected $source;
    /**
     * @Attribute(readOnly=true)
     */
    protected $date_created;

}


?>