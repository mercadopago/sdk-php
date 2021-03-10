<?php
namespace MercadoPago\Entities;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/invoices/:id", method="read") 
 * @RequestParam(param="access_token")
 */

class Invoice extends Entity
{
  
  /**
   * @Attribute()
   */
  protected $id;
  
  /**
   * @Attribute()
   */
  protected $subscription_id;
  
  /**
   * @Attribute()
   */
  protected $plan_id;
  
  /**
   * @Attribute()
   */
  protected $payer;
  
  /**
   * @Attribute()
   */
  protected $application_fee;
  
  /**
   * @Attribute()
   */
  protected $status;
  
  /**
   * @Attribute()
   */
  protected $description;
  
  /**
   * @Attribute()
   */
  protected $external_reference;
  
  /**
   * @Attribute()
   */
  protected $date_created;
  
  /**
   * @Attribute()
   */
  protected $last_modified;
  
  /**
   * @Attribute()
   */
  protected $live_mode;
  
  
  /**
   * @Attribute()
   */
  protected $metadata;
  
  /**
   * @Attribute()
   */
  protected $payments;
  
  /**
   * @Attribute()
   */
  protected $debit_date;
  
  /**
   * @Attribute()
   */
  protected $next_payment_date;
  
  
  
}

?>
  
