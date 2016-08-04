<?php

namespace MercadoPago\Annotation;
use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
class RestMethod extends Annotation
{
    public $resource;

    public $method;
}