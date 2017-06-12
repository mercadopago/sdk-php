<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;

/**
 * @RestMethod(resource="/v1/plans/:id", method="read") 
 * @RestMethod(resource="/v1/plans/", method="create")
 * @RestMethod(resource="/v1/plans/:id", method="update") 
 * @RequestParam(param="access_token")
 */

class Plan extends Entity
{
  /**
   * @Attribute()
   */
  protected $id;
  
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
  protected $auto_recurring;
  
  /**
   * @Attribute()
   */
  protected $live_mode;
  
  /**
   * @Attribute()
   */
  protected $setup_fee;
  
  /**
   * @Attribute()
   */
  protected $metadata;
  
  
  
  
}