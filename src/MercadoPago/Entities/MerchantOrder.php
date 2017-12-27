<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute; 

/**
 * @RestMethod(resource="/merchant_orders/:id", method="read") 
 * @RestMethod(resource="/merchant_orders/", method="create")
 * @RestMethod(resource="/merchant_orders/:id", method="update") 
 * @RequestParam(param="access_token")
 */

class MerchantOrder extends Entity
{
  
  /**
   * @Attribute()
   */
  protected $id;
  
  /**
   * @Attribute()
   */
  protected $preferenceId;
  
  /**
   * @Attribute()
   */
  protected $dateCreated;
  
  /**
   * @Attribute()
   */
  protected $lastUpdate;
  
  /**
   * @Attribute()
   */
  protected $applicationId;
  
  /**
   * @Attribute()
   */
  protected $status;
  
  /**
   * @Attribute()
   */
  protected $siteId;
  
  /**
   * @Attribute()
   */
  protected $payer;
  
  /**
   * @Attribute()
   */
  protected $collector;
  
  /**
   * @Attribute()
   */
  protected $sponsorId;
  
  /**
   * @Attribute()
   */
  protected $payments;
  
  /**
   * @Attribute()
   */
  protected $paidAmount;
  
  /**
   * @Attribute()
   */
  protected $refundedAmount;
  
  /**
   * @Attribute()
   */
  protected $shippingCost;
  
  /**
   * @Attribute()
   */
  protected $cancelled;
  
  /**
   * @Attribute()
   */
  protected $items;
  
  /**
   * @Attribute()
   */
  protected $shipments;
  
  /**
   * @Attribute()
   */
  protected $notificationUrl;
  
  /**
   * @Attribute()
   */
  protected $additionalInfo;
  
  /**
   * @Attribute()
   */
  protected $externalReference;
  
  /**
   * @Attribute()
   */
  protected $marketplace;
  
  /**
   * @Attribute()
   */
  protected $totalAmount;
  
}

?>