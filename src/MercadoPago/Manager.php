<?php

namespace MercadoPago;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Manager
{
    private $_client;
    private $_config;

    public function __construct(RestClient $client, Config $config)
    {
        $this->_client = $client;
        $this->_config = $config;
    }

    public function getEntityMetaData($entity)
    {
        AnnotationRegistry::registerLoader('class_exists');
        AnnotationRegistry::loadAnnotationClass('MercadoPago\\Annotation\\RestMethod');

        $reader = new AnnotationReader();
        $metaData = new MetaData($reader);

        return $metaData->getMetaData($entity);
    }

    public function execute($entity, $method = 'get', $parameters = null)
    {
        if (is_object($entity)) {
            $className = get_class($entity);
        } else {
            $className = $entity;
        }
        
        $configuration = $this->getEntityMetaData($className);

        return $this->_client->{$method}($configuration->resource, ['url_query' => ['access_token' => $this->_config->get('ACCESS_TOKEN')]]);
        
    }
}