<?php
namespace MercadoPago;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute; 


/**
 * @RestMethod(resource="/mpmobile/instore/qr/:user_id/:external_id", method="create")
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
