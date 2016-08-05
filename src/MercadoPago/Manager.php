<?php

namespace MercadoPago;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Manager Class Doc Comment
 *
 * @package MercadoPago
 */
class Manager
{
    /**
     * @var RestClient
     */
    private $_client;
    /**
     * @var Config
     */
    private $_config;

    /**
     * Manager constructor.
     *
     * @param RestClient $client
     * @param Config     $config
     */
    public function __construct(RestClient $client, Config $config)
    {
        $this->_client = $client;
        $this->_config = $config;
    }

    /**
     * @param $entity
     *
     * @return \stdClass
     */
    public function getEntityMetaData($entity)
    {
        AnnotationRegistry::registerLoader('class_exists');
        AnnotationRegistry::loadAnnotationClass('MercadoPago\\Annotation\\RestMethod');

        $reader = new AnnotationReader();
        $metaData = new MetaData($reader);

        return $metaData->getMetaData($entity);
    }

    /**
     * @param        $entity
     * @param string $method
     * @param null   $parameters
     *
     * @return mixed
     */
    public function execute($entity, $method = 'get', $parameters = null)
    {
        if (is_object($entity)) {
            $className = get_class($entity);
        } else {
            $className = $entity;
        }
        
        $configuration = $this->getEntityMetaData($className);

        $query = [];
        $params = [];
        if (isset($configuration->params)) {
            foreach ($configuration->params as $value) {
                $params[$value] = $this->_config->get(strtoupper($value));
            }
            if (count($params) > 0) {
                $query = ['url_query' => $params];
            }
        }
        return $this->_client->{$method}($configuration->resource, $query);


    }
}