<?php


namespace MercadoPago\AdvancedPayments;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;
use MercadoPago\Entity;

/**
 * @RestMethod(resource="/v1/advanced_payments", method="create")
 * @RestMethod(resource="/v1/advanced_payments/:id", method="read")
 * @RestMethod(resource="/v1/advanced_payments/search", method="search")
 * @RestMethod(resource="/v1/advanced_payments/:id", method="update")
 * @RestMethod(resource="/v1/advanced_payments/:id/refunds", method="refund")
 * @RequestParam(param="access_token")
 */
class AdvancedPayment extends Entity
{

    /**
     * @var
     * @Attribute()
     */
    protected $id;

    /**
     * @var
     * @Attribute()
     */
    protected $application_id;

    /**
     * @var
     */
    protected $payments;

    /**
     * @var
     */
    protected $disbursements;

    /**
     * @var
     */
    protected $payer;

    /**
     * @var
     */
    protected $external_reference;

    /**
     * @var
     */
    protected $description;

    /**
     * @var
     */
    protected $binary_mode;

    /**
     * @var
     */
    protected $status;

    /**
     * @var
     */
    protected $capture;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function cancel() {
        $this->status = 'cancelled';

        return $this->update();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function capture()
    {
        $this->capture = true;

        return $this->update();
    }

    /**
     * @param int $amount
     * @return bool
     * @throws \Exception
     */
    public function refund($amount = 0){
        $refund = new Refund(["advanced_payment_id" => $this->id]);
        if ($amount > 0){
            $refund->amount = $amount;
        }

        if ($refund->save()){
            $advanced_payment = self::get($this->id);
            $this->_fillFromArray($this, $advanced_payment->toArray());
            return true;
        }else{
            $this->error = $refund->error;
            return false;
        }
    }


    /**
     * @param $disbursement_id
     * @param int $amount
     * @return bool
     * @throws \Exception
     */
    public function refundDisbursement($disbursement_id, $amount = 0){
        $refund = new DisbursementRefund(["advanced_payment_id" => $this->id, "disbursement_id" => $disbursement_id]);
        if ($amount > 0){
            $refund->amount = $amount;
        }

        if ($refund->save()){
            $advanced_payment = self::get($this->id);
            $this->_fillFromArray($this, $advanced_payment->toArray());
            return true;
        }else{
            $this->error = $refund->error;
            return false;
        }
    }
}