<?php
namespace MercadoPago\Entities;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/preapproval/:id", method="read")
 * @RestMethod(resource="/preapproval/search", method="search")
 * @RestMethod(resource="/preapproval/", method="create")
 * @RestMethod(resource="/preapproval/:id", method="update") 
 * @RequestParam(param="access_token")
 */

class Preapproval extends Entity
{
  
  /**
   * @Attribute()
   */
  protected $id;
  
  /**
   * @Attribute()
   */
  protected $payer_id;
  
  /**
   * @Attribute()
   */
  protected $payer_email;
  
  /**
   * @Attribute()
   */
  protected $back_url;
  
  /**
   * @Attribute()
   */
  protected $collector_id;
  
  /**
   * @Attribute()
   */
  protected $application_id;
  
  /**
   * @Attribute()
   */
  protected $status;
  
  /**
   * @Attribute()
   */
  protected $auto_recurring;
  
  /**
   * @Attribute()
   */
  protected $init_point;
  
  /**
   * @Attribute()
   */
  protected $sandbox_init_point;
  
  /**
   * @Attribute()
   */
  protected $reason;
  
  
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
  protected $preapproval_plan_id;
  
}

?>