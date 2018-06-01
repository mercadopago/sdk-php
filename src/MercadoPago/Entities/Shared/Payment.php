<?php
namespace MercadoPago;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute; 

/**
 * @RestMethod(resource="/v1/payments", method="create")
 * @RestMethod(resource="/v1/payments/:id", method="read")
 * @RestMethod(resource="/v1/payments/search", method="search")
 * @RestMethod(resource="/v1/payments/:id", method="update")
 * @RestMethod(resource="/collections/:id/refunds", method="refund")
 * @RequestParam(param="access_token")
 */
class Payment extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     */
    protected $id;
    /**
     * @Attribute(idempotency = true)
     */
    protected $site_id;
    /**
     * @Attribute()
     */
    protected $operation_type;
    /**
     * @Attribute(idempotency = true)
     */
    protected $order_id;
    /**
     * @Attribute()
     */
    protected $binary_mode;
    /**
     * @Attribute()
     */
    protected $external_reference;
    /**
     * @Attribute()
     */
    protected $status;
    /**
     * @Attribute()
     */
    protected $status_detail;
    /**
     * @Attribute(type = "string")
     */
    protected $payment_type;
    /**
     * @Attribute()
     */
    protected $date_created;
    /**
     * @Attribute()
     */
    protected $last_modified;
    /**
     * @Attribute()
     */
    protected $date_approved;
    /**
     * @Attribute()
     */
    protected $money_release_date;
    /**
     * @Attribute()
     */
    protected $currency_id;
    /**
     * @Attribute(type = "float")
     */
    protected $transaction_amount;
    /**
     * @Attribute()
     */
    protected $shipping_cost;
    /**
     * @Attribute(idempotency = true)
     */
    protected $total_paid_amount;
    /**
     * @Attribute(type = "float")
     */
    protected $finance_charge;
    /**
     * @Attribute()
     */
    protected $net_received_amount;
    /**
     * @Attribute()
     */
    protected $marketplace;
    /**
     * @Attribute(type = "float")
     */
    protected $marketplace_fee;
    /**
     * @Attribute()
     */
    protected $reason;
    /**
     * @Attribute()
     */
    protected $payer;
    /**
     * @Attribute()
     */
    protected $collector;
    /**
     * @Attribute()
     */
    protected $payment_method_id;
    // For flavor 1
    /**
     * @Attribute()
     */
    protected $transaction_details;
    /**
     * @Attribute()
     */
    protected $fee_details;
    /**
     * @Attribute()
     */
    protected $differential_pricing_id;
    /**
     * @Attribute()
     */
    protected $application_fee;
    /**
     * @Attribute()
     */
    protected $capture;
    /**
     * @Attribute()
     */
    protected $captured;
    /**
     * @Attribute()
     */
    protected $call_for_authorize_id;
    /**
     * @Attribute()
     */
    protected $statement_descriptor;
    /**
     * @Attribute()
     */
    protected $refunds;
    /**
     * @Attribute()
     */
    protected $additional_info;
    /**
     * @Attribute()
     */
    protected $campaign_id;
    /**
     * @Attribute()
     */
    protected $coupon_amount;
    /**
     * @Attribute(type = "int")
     */
    protected $installments;
    /**
     * @Attribute()
     */
    protected $token;
    /**
     * @Attribute()
     */
    protected $description;
     /**
     * @Attribute()
     */
    protected $notification_url;
    
    
    
}