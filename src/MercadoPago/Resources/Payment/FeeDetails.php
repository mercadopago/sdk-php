<?php

namespace MercadoPago\Resources\Payment;

/** FeeDetails class. */
class FeeDetails
{
  /** Fee type. */
  public $type;

  /** Who absorbs the cost. */
  public $fee_payer;

  /** Fee amount. */
  public $amount;
}
