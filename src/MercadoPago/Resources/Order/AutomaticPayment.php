<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

/** Automatic Payment Class */
class AutomaticPayment
{
  /** Payment profile id */
  public ?string $payment_profile_id;

  /** Retries */
  public ?int  $retries;

  /** Schedule Date */
  public ?string $schedule_date;

  /** Due Date */
  public ?string $due_date;
}