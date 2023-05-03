<?php

namespace MercadoPago\Resources\Payment;

/** TransactionDetails class. */
class TransactionDetails
{
  /** External financial institution identifier. */
  public $financial_institution;

  /** Amount received by the seller. */
  public $net_received_amount;

  /** Total amount paid by the buyer (includes fees). */
  public $total_paid_amount;

  /** Total installments amount. */
  public $installment_amount;

  /** Amount overpaid (only for tickets). */
  public $overpaid_amount;

  /** Identifies the resource in the payment processor. */
  public $external_resource_url;

  /**
   * For credit card payments is the USN. For offline payment methods, is the reference to give to
   * the cashier or to input into the ATM.
   */
  public $payment_method_reference_id;

  /** Acquirer Reference. */
  public $acquirer_reference;

  /** Payable deferral period. */
  public $payable_deferral_period;

  /** Bank transfer ID. */
  public $bank_transfer_id;

  /** Transaction ID. */
  public $transaction_id;
}
