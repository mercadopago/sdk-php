<?php
namespace MercadoPago;
use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute; 

/**
 * Payments class
 *
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
     * ID
     * @var long
     * @Attribute(primaryKey = true)
     */
    protected $id;

    /**
     * Acquirer
     * @var string
     * @Attribute()
     */
    protected $acquirer;

    /**
     * Acquirer reconciliation
     * @var string
     * @Attribute()
     */
    protected $acquirer_reconciliation;

    /**
     * Site ID
     * @var string
     * @Attribute(idempotency = true)
     */
    protected $site_id;

    /**
     * Sponsor ID
     * @var long
     * @Attribute()
     */
    protected $sponsor_id;

    /**
     * Operation Type
     * @var string
     * @Attribute()
     */
    protected $operation_type;

    /**
     * Order ID
     * @var long
     * @Attribute(idempotency = true)
     */
    protected $order_id;

    /**
     * Order
     * @var long
     * @Attribute()
     */
    protected $order;

    /**
     * Binary Mode
     * @var boolean
     * @Attribute()
     */
    protected $binary_mode;

    /**
     * External Reference
     * @var string
     * @Attribute()
     */
    protected $external_reference;

    /**
     * Status
     * @var string
     * @Attribute()
     */
    protected $status;

    /**
     * Status Detail
     * @var string
     * @Attribute()
     */
    protected $status_detail;

    /**
     * Status Detail
     * @var long
     * @Attribute()
     */
    protected $store_id;

    /**
     * Tax Amount
     * @var array
     * @Attribute()
     */
    protected $taxes_amount;

    /**
     * Payment Type
     * @var string
     * @Attribute(type = "string")
     */
    protected $payment_type;

    /**
     * Date Created
     * @var string
     * @Attribute()
     */
    protected $date_created;

    /**
     * Last Modified
     * @var string
     * @Attribute()
     */
    protected $last_modified;

    /**
     * Live Mode
     * @var boolean
     * @Attribute()
     */
    protected $live_mode;

    /**
     * Date last updated
     * @var string
     * @Attribute()
     */
    protected $date_last_updated;

    /**
     * Date of expiration
     * @var string
     * @Attribute()
     */
    protected $date_of_expiration;

    /**
     * Deduction schema
     * @var string
     * @Attribute()
     */
    protected $deduction_schema;

    /**
     * Date approved
     * @var string
     * @Attribute()
     */
    protected $date_approved;

    /**
     * Money release date
     * @var string
     * @Attribute()
     */
    protected $money_release_date;

    /**
     * Money release schema
     * @var string
     * @Attribute()
     */
    protected $money_release_schema;

    /**
     * Currency id
     * @var string
     * @Attribute()
     */
    protected $currency_id;

    /**
     * Transaction amount
     * @var float
     * @Attribute(type = "float")
     */
    protected $transaction_amount;

    /**
     * Transaction amount refunded
     * @var float
     * @Attribute(type = "float")
     */
    protected $transaction_amount_refunded;

    /**
     * Shipping cost
     * @var float
     * @Attribute()
     */
    protected $shipping_cost;

    /**
     * Total paid amount
     * @var float
     * @Attribute(idempotency = true)
     */
    protected $total_paid_amount;

    /**
     * Finance charge
     * @var float
     * @Attribute(type = "float")
     */
    protected $finance_charge;

    /**
     * Net received amount
     * @var float
     * @Attribute()
     */
    protected $net_received_amount;

    /**
     * Marketplace
     * @var string
     * @Attribute()
     */
    protected $marketplace;

    /**
     * Marketplace fee
     * @var float
     * @Attribute(type = "float")
     */
    protected $marketplace_fee;

    /**
     * Reason
     * @var string
     * @Attribute()
     */
    protected $reason;

    /**
     * Payer
     * @var array
     * @Attribute()
     */
    protected $payer;

    /**
     * Collector
     * @var array
     * @Attribute()
     */
    protected $collector;

    /**
     * Collector ID
     * @var long
     * @Attribute()
     */
    protected $collector_id;

    /**
     * Counter currency
     * @var string
     * @Attribute()
     */
    protected $counter_currency;

    /**
     * Payment method ID
     * @var string
     * @Attribute()
     */
    protected $payment_method_id;
    // For flavor 1

    /**
     * Payment type ID
     * @var string
     * @Attribute()
     */
    protected $payment_type_id;

    /**
     * POS ID
     * @var string
     * @Attribute()
     */
    protected $pos_id;

    /**
     * Transaction details
     * @var array
     * @Attribute()
     */
    protected $transaction_details;

    /**
     * Fee details
     * @var array
     * @Attribute()
     */
    protected $fee_details;

    /**
     * Differential pricing ID
     * @var long
     * @Attribute()
     */
    protected $differential_pricing_id;

    /**
     * Application fee
     * @var float
     * @Attribute()
     */
    protected $application_fee;

    /**
     * Authorization code
     * @var string
     * @Attribute()
     */
    protected $authorization_code;

    /**
     * Capture
     * @var boolean
     * @Attribute()
     */
    protected $capture;

    /**
     * Captured
     * @var boolean
     * @Attribute()
     */
    protected $captured;

    /**
     * Card
     * @var long
     * @Attribute()
     */
    protected $card;

    /**
     * Call for authorize ID
     * @var string
     * @Attribute()
     */
    protected $call_for_authorize_id;

    /**
     * Statement descriptor
     * @var string
     * @Attribute()
     */
    protected $statement_descriptor;

    /**
     * Refunds
     * @var array
     * @Attribute()
     */
    protected $refunds;

    /**
     * Shipping amount
     * @var float
     * @Attribute()
     */
    protected $shipping_amount;

    /**
     * Additional info
     * @var array
     * @Attribute()
     */
    protected $additional_info;

    /**
     * Campaign ID
     * @var string
     * @Attribute()
     */
    protected $campaign_id;

    /**
     * Coupon amount
     * @var float
     * @Attribute()
     */
    protected $coupon_amount;
    /**
     * Installments
     * @var int
     * @Attribute(type = "int")
     */
    protected $installments;

    /**
     * Token
     * @var string
     * @Attribute()
     */
    protected $token;

    /**
     * Description
     * @var string
     * @Attribute()
     */
    protected $description;

    /**
     * Notification URL
     * @var string
     * @Attribute()
     */
    protected $notification_url;

    /**
     * Issuer ID
     * @var string
     * @Attribute()
     */
    protected $issuer_id;

    /**
     * Processing mode
     * @var string
     * @Attribute()
     */
    protected $processing_mode;

    /**
     * Merchant account id
     * @var long
     * @Attribute()
     */
    protected $merchant_account_id;

    /**
     * Merchant number
     * @var long
     * @Attribute()
     */
    protected $merchant_number;

    /**
     * Metadata
     * @var array
     * @Attribute()
     */
    protected $metadata;

    /**
     * Callback URL
     * @var string
     * @Attribute()
     */
    protected $callback_url;

    /**
     * Amount refunded
     * @var float
     * @Attribute()
     */
    protected $amount_refunded;

    /**
     * Coupon code
     * @var string
     * @Attribute()
     */
    protected $coupon_code;

    /**
     * Barcode
     * @var string
     * @Attribute()
     */
    protected $barcode;

    /**
     * Marketplace owner
     * @var long
     * @Attribute()
     */
    protected $marketplace_owner;

    /**
     * Integrator ID
     * @var string
     * @Attribute()
     */
    protected $integrator_id;

    /**
     * Corporation ID
     * @var string
     * @Attribute()
     */
    protected $corporation_id;

    /**
     * Platform ID
     * @var string
     * @Attribute()
     */
    protected $platform_id;

    /**
     * Refund
     * @param int $amount
     * @return bool
     * @throws \Exception
     */
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

    /**
     * Capture
     * @param int $amount
     * @return Payment
     * @throws \Exception
     */
    public function capture($amount = 0)
    {
        $this->capture = true;
        if ($amount > 0){
            $this->transaction_amount = $amount;
        }

        return $this->update();
    }
}
