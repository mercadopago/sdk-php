<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

/** Automatic Payment Class */
class StoredCredential
{
  /** Payment profile id */
  public ?string $payment_initiator;

  /** Retries */
  public ?string $reason;

  /** Schedule Date */
  public ?bool $store_payment_method;

  /** Due Date */
  public ?bool $first_payment;
}