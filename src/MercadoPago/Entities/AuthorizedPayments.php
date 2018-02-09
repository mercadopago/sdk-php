<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/authorized_payment", method="create")
 * @RestMethod(resource="/authorized_payment/:id", method="read")
 * @RestMethod(resource="/authorized_payment/search", method="search")
 * @RestMethod(resource="/authorized_payment/:id", method="update")
 * @RequestParam(param="access_token")
 */

class AuthorizedPayment extends Entity
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
    protected $preapproval_id;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $type;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $status;

    /**
     * @Attribute(type = "date")
     * @var
     */
    protected $date_created;

    /**
     * @Attribute(type = "date")
     * @var
     */
    protected $last_modified;

    /**
     * @Attribute(type = "float")
     * @var
     */
    protected $transaction_amount;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $currency_id;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $reason;

     /**
     * @Attribute(type = "string")
     * @var
     */
    protected $external_reference;

     /**
     * @Attribute(type = "object")
     * @var
     */
    protected $payment;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $rejection_code;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $retry_attempt;

    /**
     * @Attribute(type = "date")
     * @var
     */
    protected $next_retry_date;

    /**
     * @Attribute(type = "date")
     * @var
     */
    protected $last_retry_date;

    /**
     * @Attribute(type = "date")
     * @var
     */
    protected $expire_date;

    /**
     * @Attribute(type = "date")
     * @var
     */
    protected $debit_date;

    /**
     * @Attribute(type = "string")
     * @var
     */
    protected $coupon_code;


}

?>