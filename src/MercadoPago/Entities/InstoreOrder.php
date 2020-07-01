<?php
/**
 * Instore Order class file
 */
namespace MercadoPago;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute; 


/**
 * Instore Order class
 * @RestMethod(resource="/mpmobile/instore/qr/:user_id/:external_id", method="create")
 * @RequestParam(param="access_token")
 */
class InstoreOrder extends Entity
{
    /**
     * id
     * @Attribute()
     * @var int
     */
    protected $id;

    /**
     * external_reference
     * @Attribute()
     * @var string
     */
    protected $external_reference;

    /**
     * notification_url
     * @Attribute()
     * @var string
     */
    protected $notification_url;

    /**
     * items
     * @Attribute()
     * @var array
     */
    protected $items;

}
