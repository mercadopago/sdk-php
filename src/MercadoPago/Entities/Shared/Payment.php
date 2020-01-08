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
 * @RestMethod(resource="/v1/payments/:id/refunds", method="refund")
 * @RequestParam(param="access_token")
 */
class Payment extends Entity
{
    /**
     * @Attribute(primaryKey = true)
     */
    protected $id;
    /**
     * @Attribute()
     */
    protected $acquirer;
    /**
     * @Attribute()
     */
    protected $acquirer_reconciliation;
    /**
     * @Attribute(idempotency = true)
     */
    protected $site_id;
    /**
     * @Attribute()
     */
    protected $sponsor_id;
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
    protected $order;
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
     * @Attribute()
     */
    protected $store_id;
    /**
     * @Attribute()
     */
    protected $taxes_amount;
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
    protected $live_mode;
    /**
     * @Attribute()
     */
    protected $date_last_updated;
    /**
     * @Attribute()
     */
    protected $date_of_expiration;
    /**
     * @Attribute()
     */
    protected $deduction_schema;
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
    protected $money_release_schema;
    /**
     * @Attribute()
     */
    protected $currency_id;
    /**
     * @Attribute(type = "float")
     */
    protected $transaction_amount;
    /**
     * @Attribute(type = "float")
     */
    protected $transaction_amount_refunded;
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
    protected $collector_id;
    /**
     * @Attribute()
     */
    protected $counter_currency;
    /**
     * @Attribute()
     */
    protected $payment_method_id;
    // For flavor 1
    /**
     * @Attribute()
     */
    protected $payment_type_id;
    /**
     * @Attribute()
     */
    protected $pos_id;
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
    protected $authorization_code;
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
    protected $card;
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
    protected $shipping_amount;
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
    /** 
     * @Attribute()
     */
    protected $issuer_id;
    /**
     * @Attribute()
     */
    protected $processing_mode;
    /**
     * @Attribute()
     */
    protected $merchant_account_id; 
    /**
     * @Attribute()
     */
    protected $merchant_number; 
    /**
     * @Attribute()
     */
    protected $metadata;
    /**
     * @Attribute()
     */
    protected $callback_url;
    /**
     * @Attribute()
     */
    protected $amount_refunded;
    /**
     * @Attribute()
     */
    protected $coupon_code;
    /**
     * @Attribute()
     */
    protected $barcode;
    /**
     * @Attribute()
     */
    protected $marketplace_owner;
    /**
     * @Attribute()
     */
    protected $integrator_id;
    /**
     * @Attribute()
     */
    protected $corporation_id;
    /**
     * @Attribute()
     */
    protected $platform_id;

    public function refund($amount = 0){
        $refund = new Refund(["payment_id" => $this->id]);
        if ($amount > 0){
            $refund->amount = $amount;
        }

        if ($refund->save()){
            $payment = self::get($this->id);
            $this->_fillFromArray($this, $payment->toArray());
            return true;
        }else{
            $this->error = $refund->error;
            return false;
        }
    }

    public function capture($amount = 0)
    {
        $this->capture = true;
        if ($amount > 0){
            $this->transaction_amount = $amount;
        }

        return $this->update();
    }
}
