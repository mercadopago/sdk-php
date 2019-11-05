<?php
namespace MercadoPago;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute; 


/**
 * @RestMethod(resource="/mpmobile/instore/qr/:user_id/:external_id", method="create")
 * @RequestParam(param="access_token")
 */
class InstoreOrder extends Entity
{
    /**
     * @Attribute()
     */
    protected $id;

    /**
     * @Attribute()
     */
    protected $external_reference;

    /**
     * @Attribute()
     */
    protected $notification_url;

    /**
     * @Attribute()
     */
    protected $items;

}


?>
