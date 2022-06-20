<?php

namespace MercadoPago\Resources\Payment;

/** PaymentPointOfInteractionTransactionData class. */
class PaymentPointOfInteractionTransactionData
{
  /** QR code. */
  public $qr_code;

  /** QR code image in Base 64. */
  public $qr_code_base64;

  /** Transaction ID. */
  public $transaction_id;

  /** Bank transfer ID. */
  public $bank_transfer_id;

  /** Financial institution. */
  public $financial_institution;

  /** Bank info. */
  public $bank_info;

  /** Ticket Url. */
  public $ticket_url;
}
