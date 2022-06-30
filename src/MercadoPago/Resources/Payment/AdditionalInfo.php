<?php

namespace MercadoPago\Resources\Payment;

/** AdditionalInfo class. */
class AdditionalInfo
{
  /** IP from where the request comes from (only for bank transfers). */
  public $ip_address;

  /** List of items to be paid. */
  public $items;

  /** Payer's information. */
  public $payer;

  /** Shipping information. */
  public $shipments;

  /**
   * Method responsible for mapping class attributes.
   */
  public static function map(string $field)
  {
    $map = [
      "payer" => "MercadoPago\Resources\Payment\AdditionalInfoPayer",
      "shipments" => "MercadoPago\Resources\Payment\Shipments"
    ];

    foreach ($map as $key => $value) {
      if ($key === $field) {
        return $value;
      }
    }
  }
}
