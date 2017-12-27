<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/subscriptions/:id", method="read") 
 * @RestMethod(resource="/v1/subscriptions/", method="create")
 * @RestMethod(resource="/v1/subscriptions/:id", method="update") 
 * @RequestParam(param="access_token")
 */

class Subscription extends Entity
{
  
  /**
   * @Attribute()
   */
  protected $id;

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
  protected $start_date;
  
  /**
   * @Attribute()
   */
  protected $end_date;
  
  /**
   * @Attribute()
   */
  protected $metadata;
  
  /**
   * @Attribute()
   */
  protected $charges_detail;
  
  /**
   * @Attribute()
   */
  protected $setup_fee;
   
  
}

?>