<?php

namespace MercadoPago\Annotations;

/**
 * Contains routing information about a specific entity
 *
 */
class Routing {

    /**
     * @var Insert
     */
    private $post;

    /**
     * @var Update
     */
    private $put;

    /**
     * @var Select
     */
    private $get;

    /**
     * @var Delete
     */
    private $delete;

    /**
     * @var Fetch
     */
    private $getAll;

    /**
     * @var array
     */
    private static $annotations = [
        'post'   => 'Circle\DoctrineRestDriver\Annotations\Insert',
        'put'    => 'Circle\DoctrineRestDriver\Annotations\Update',
        'get'    => 'Circle\DoctrineRestDriver\Annotations\Select',
        'delete' => 'Circle\DoctrineRestDriver\Annotations\Delete',
        'getAll' => 'MercadoPago\Annotations\Fetch'
    ];

    /**
     * Routing constructor
     *
     * @param string $namespace
     */
    public function __construct($namespace) {
        $reader = new Reader();
        $class  = new \ReflectionClass($namespace);

        foreach (self::$annotations as $alias => $annotation) $this->$alias = $reader->read($class, $annotation);
    }

    /**
     * returns the post route
     *
     * @return string|null
     */
    public function post() {
        return $this->post;
    }

    /**
     * returns the get route
     *
     * @return string|null
     */
    public function get() {
        return $this->get;
    }

    /**
     * returns the put route
     *
     * @return string|null
     */
    public function put() {
        return $this->put;
    }

    /**
     * returns the delete route
     *
     * @return string|null
     */
    public function delete() {
        return $this->delete;
    }

    /**
     * returns the get all route
     *
     * @return string|null
     */
    public function getAll() {
        return $this->getAll;
    }
}