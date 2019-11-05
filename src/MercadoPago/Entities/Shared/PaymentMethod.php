<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/payment_methods", method="list")
 * @RequestParam(param="access_token")
 */

class PaymentMethod extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     * @var
     */
    protected $id;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $name;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $payment_type_id;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $status;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $secure_thumbnail;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $thumbnail;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $deferred_capture;

    /**
     * @Attribute()
     * @var
     */
    protected $settings;

    /**
     * @Attribute()
     * @var
     */
    protected $additional_info_needed;

    /**
     * @Attribute(type = "float")
     * @var
     */
    protected $min_allowed_amount;

    /**
     * @Attribute(type = "float")
     * @var
     */
    protected $max_allowed_amount;

    /**
     * @Attribute(type = "integer")
     * @var
     */
    protected $accreditation_time;

    /**
     * @Attribute(type = "")
     * @var
     */
    protected $financial_institutions;

    /**
     * @Attribute(type = "")
     * @var
     */
    protected $processing_modes;
}