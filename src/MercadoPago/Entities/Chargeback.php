<?php
namespace MercadoPago;

use MercadoPago\Annotation\RestMethod;
use MercadoPago\Annotation\RequestParam;
use MercadoPago\Annotation\Attribute;


/**
 * @RestMethod(resource="/v1/chargebacks/:id", method="read")
 * @RequestParam(param="access_token")
 */
class Chargeback extends Entity
{
    /**
     * @Attribute(primaryKey = true, type = "string", readOnly = true)
     */
    protected $id;
    /**
     * @Attribute(type = "array", readOnly = true)
     */
    protected $payments;
    /**
     * @Attribute(type = "string", readOnly = true)
     */
    protected $amount;
    /**
     * @Attribute(type = "float", readOnly = true)
     */
    protected $coverage_applied;
    /**
     * @Attribute(readOnly = true)
     */
    protected $coverage_elegible;
    /**
     * @Attribute(readOnly = true)
     */
    protected $documentation_required;
    /**
     * @Attribute(readOnly = true)
     */
    protected $documentation_status;
    /**
     * @Attribute(type = "string", readOnly = true)
     */
    protected $documentation;
    /**
     * @Attribute(type = "array", readOnly = true)
     */
    protected $date_documentation_deadline;
    /**
     * @Attribute(type = "date", readOnly = true)
     */
    protected $date_created;
    /**
     * @Attribute(type = "date", readOnly = true)
     */
    protected $date_last_updated;
    /**
     * @Attribute(type = "date", readOnly = true)
     */
    protected $live_mode;
    /**
     * @Attribute(readOnly = true)
     */

}


?>