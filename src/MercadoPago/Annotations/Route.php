<?php
namespace MercadoPago\Annotations;

/**
 * Trait for all annotations regarding routes
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 *
 * @Annotation
 */
trait Route {

    /**
     * @var string
     */
    private $route;

    /**
     * Constructor
     *
     * @param array $values
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function __construct(array $values) {
        $route = $values['value'];
        $this->route = $route;
    }

    /**
     * returns the route
     *
     * @return string
     */
    public function getRoute() {
        return $this->route;
    }
}