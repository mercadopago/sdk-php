<?php

namespace MercadoPago\Resources\Payment;

/** Payer class. */
class PaymentPayer
{
  /** Payer's identification type (mandatory if the payer is a Customer). */
  public $type;

  /** Payer's ID. */
  public $id;

  /** Email of the payer. */
  public $email;

  /** Payer's personal identification. */
  public $identification;

  /** Payer's first name. */
  public $first_name;

  /** Payer's last name. */
  public $last_name;

  /** Payer's entity type (only for bank transfers). */
  public $entity_type;
}
