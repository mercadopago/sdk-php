<?php

namespace MercadoPago\Resources\Payment;

/** PaymentRefunds class. */
class PaymentRefunds
{
  /** Refund id. */
  public $id;

  /** ID of the refunded payment. */
  public $payment_id;

  /** Amount refunded. */
  public $amount;

  /** Adjustment amount. */
  public $adjustment_amount;

  /** Refund status. */
  public $status;

  /** Refund mode. */
  public $refund_mode;

  /** Date of creation. */
  public $date_created;

  /** Refund reason. */
  public $reason;

  /** Unique sequence number. */
  public $unique_sequence_number;

  /** Source of the refund. */
  public $source;
}
