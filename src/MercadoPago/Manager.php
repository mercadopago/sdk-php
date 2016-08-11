<?php

namespace MercadoPago;


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
    private $_entityConfiguration;
    private $_metadataReader;

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
        $this->_metadataReader = new MetaData();
    }

    /**
     * @param $entity
     *
     * @return \stdClass
     */
    public function getEntityMetaData($entity)
    {
        if (isset($this->_entityConfiguration[$entity])) {
            return $this->_entityConfiguration[$entity];
        }

        $this->_entityConfiguration[$entity] =  $this->_metadataReader->getMetaData($entity);
        
        return $this->_entityConfiguration[$entity];
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

    public function getPropertyType($entity, $property)
    {
        $metaData = $this->getEntityMetaData($entity);

        return $metaData->attribute[$property]['type'];
    }
}