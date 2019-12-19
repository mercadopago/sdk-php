<?php
namespace MercadoPago;

use MercadoPago\Annotation\Attribute;

/**
 * TrackValues class
 *
 * @package MercadoPago
 */
class TrackValues extends Entity
{
    /**
     * @Attribute(type = "string")
     */
    protected $conversion_id;
    /**
     * @Attribute(type = "string")
     */
    protected $conversion_label;
    /**
     * @Attribute(type = "string")
     */
    protected $pixel_id;
}