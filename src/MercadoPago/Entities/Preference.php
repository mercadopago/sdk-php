<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/checkout/preferences", method="create")
 * @RestMethod(resource="/checkout/preferences/:id", method="read")
 * @RestMethod(resource="/checkout/preferences/:id", method="update")
 * @RequestParam(param="access_token") 
 */
class Preference extends Entity
{
    /**
     * @Attribute(primaryKey = true, type = "string", readOnly = true)
     */
    protected $id;
    /**
     * @Attribute()
     */
    protected $auto_return;
    /**
     * @Attribute()
     */
    protected $back_urls;
    /**
     * @Attribute(type = "string", maxLength = 500)
     */
    protected $notification_url;
    /**
     * @Attribute(type = "string", readOnly = true)
     */
    protected $init_point;
    /**
     * @Attribute(type = "string", readOnly = true)
     */
    protected $sandbox_init_point;
    /**
     * @Attribute(type = "string", readOnly = true)
     */
    protected $operation_type;
    /**
     * @Attribute(type = "string", maxLength = 600)
     */
    protected $additional_info;
    /**
     * @Attribute(type = "string", maxLength = 256)
     */
    protected $external_reference;
    /**
     * @Attribute()
     */
    protected $expires;
    /**
     * @Attribute(type = "date")
     */
    protected $expiration_date_from;
    /**
     * @Attribute(type = "date")
     */
    protected $expiration_date_to;
    /**
     * @Attribute(type = "int", readOnly = true)
     */
    protected $collector_id;
    /**
     * @Attribute(type = "int", readOnly = true)
     */
    protected $client_id;
    /**
     * @Attribute(type = "string")
     */
    protected $marketplace;
    /**
     * @Attribute(type = "float")
     */
    protected $marketplace_fee;
    /**
     * @Attribute()
     */
    protected $differential_pricing;
    /**
     * @Attribute()
     */
    protected $payment_methods;
    /**
     * @Attribute(type = "array", required = "true")
     */
    protected $items;
    /**
     * @Attribute(type = "object")
     */
    protected $payer;
    /**
     * @Attribute(type = "object")
     */
    protected $shipments;
    /**
     * @Attribute(type = "date")
     */
    protected $date_created;
    /**
     * @Attribute(type = "integer")
     */
    protected $sponsor_id;
    /**
     * @Attribute(type = "array")
     */
    protected $processing_modes;
    /**
     * @Attribute()
     */
    protected $binary_mode;
    /**
     * @Attribute(type = "array")
     */
    protected $taxes;
    /**
     * @Attribute()
     */
    protected $metadata;
    /**
     * @Attribute(type = "array")
     */
    protected $tracks;

}