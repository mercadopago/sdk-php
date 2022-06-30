<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** AdditionalInfo class. */
class AdditionalInfo
{
  /** Class mapper. */
  use Mapper;

  /** IP from where the request comes from (only for bank transfers). */
  public $ip_address;

  /** List of items to be paid. */
  public $items;

  /** Payer's information. */
  public $payer;

  /** Shipping information. */
  public $shipments;

  private $map = [
    "payer" => "MercadoPago\Resources\Payment\AdditionalInfoPayer",
    "shipments" => "MercadoPago\Resources\Payment\Shipments"
  ];

  /**
   * Method responsible for getting map of entities.
   */
  public function getMap()
  {
    return $this->map;
  }
}
