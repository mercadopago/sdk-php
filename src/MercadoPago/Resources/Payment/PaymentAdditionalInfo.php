<?php

namespace MercadoPago\Resources\Payment;

/** PaymentAdditionalInfo class. */
class PaymentAdditionalInfo
{
  /** IP from where the request comes from (only for bank transfers). */
  public $ip_address;

  /** List of items to be paid. */
  public $items;

  /** Payer's information. */
  public $payer;

  /** Shipping information. */
  public $shipments;
}
