<?php

namespace MercadoPago\Resources\Payment;

/** PaymentFeeDetails class. */
class PaymentFeeDetails
{
  /** Fee type. */
  public $type;

  /** Who absorbs the cost. */
  public $fee_payer;

  /** Fee amount. */
  public $amount;
}
