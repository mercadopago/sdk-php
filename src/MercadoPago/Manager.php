<?php

namespace MercadoPago;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class Manager
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
     * @var
     */
    private $_entityConfiguration;
    /**
     * @var MetaData
     */
    private $_metadataReader;
    /**
     * @var string
     */
    static $CIPHER = 'sha256';

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
     */
    protected function _getEntityConfiguration($entity)
    {
        if (isset($this->_entityConfiguration[$entity])) {
            return $this->_entityConfiguration[$entity];
        }

        $this->_entityConfiguration[$entity] = $this->_metadataReader->getMetaData($entity);

        return $this->_entityConfiguration[$entity];
    }

    /**
     * @param        $entity
     * @param string $method
     * @param null   $parameters
     *
     * @return mixed
     */
    public function execute($entity, $method = 'get')
    {
        $className = $this->_getEntityClassName($entity);
        $configuration = $this->_entityConfiguration[$className];

        $this->_setDefaultHeaders($configuration->query);
        $this->_setIdempotencyHeader($configuration->query, $configuration, $method);
        $this->setQueryParams($configuration);

        return $this->_client->{$method}($configuration->url, $configuration->query);
    }

    public function setEntityUrl($entity, $ormMethod)
    {
        $className = $this->_getEntityClassName($entity);
        if (!isset($this->_entityConfiguration[$className]->methods[$ormMethod])) {
            throw new Exception('ORM method ' . $ormMethod . ' not available for entity:' . $className);
        }
        $this->_entityConfiguration[$className]->url = $this->_entityConfiguration[$className]->methods[$ormMethod]['resource'];
    }

    public function setEntityMetadata($entity)
    {
        return $this->_getEntityConfiguration($this->_getEntityClassName($entity));
    }

    protected function _getEntityClassName($entity)
    {
        if (is_object($entity)) {
            $className = get_class($entity);
        } else {
            $className = $entity;
        }

        return $className;
    }

    public function setEntityQueryJsonData($entity)
    {
        $className = $this->_getEntityClassName($entity);
        $result = [];
        $this->_attributesToJson($entity, $result, $this->_entityConfiguration[$className]);
        $this->_entityConfiguration[$className]->query['json_data'] = json_encode($result);
    }

    public function setQueryParams($configuration)
    {
        $params = [];
        if (isset($configuration->params)) {
            foreach ($configuration->params as $value) {
                $params[$value] = $this->_config->get(strtoupper($value));
            }
            if (count($params) > 0) {
                $configuration->query['url_query'] = $params;
            }
        }
    }

    /**
     *
     * @return mixed
     */
    public function fillFromResponse($entity, $data)
    {
        foreach ($data as $key => $value) {
            //if (is_array($value)) {
            //    continue; // TODO build object nested structure
            //}
            $entity->{$key} = $value;
        }
    }

    /**
     *
     * @return mixed
     */
    protected function _attributesToJson($entity, &$result, $configuration)
    {
        $attributes = array_filter($entity->toArray($configuration->attributes));
        foreach ($attributes as $key => $value) {
            if ($value instanceof Entity) {
                $this->_attributesToJson($value, $result[$key], $configuration);
            } else {
                $result[$key] = $value;
            }
        }
    }

    /**
     * @param $entity
     * @param $property
     *
     * @return mixed
     */
    public function getPropertyType($entity, $property)
    {
        $metaData = $this->_getEntityConfiguration($entity);

        return $metaData->attributes[$property]['type'];
    }

    public function getDynamicAttributeDenied($entity)
    {
        $metaData = $this->_getEntityConfiguration($entity);

        return isset($metaData->denyDynamicAttribute);
    }

    /**
     * @param $query
     */
    protected function _setDefaultHeaders(&$query)
    {
        $query['headers']['Accept'] = 'application/json';
        $query['headers']['User-Agent'] = 'Mercado Pago Php SDK v' . Version::$_VERSION;
    }

    /**
     * @param        $query
     * @param        $configuration
     * @param string $method
     */
    protected function _setIdempotencyHeader(&$query, $configuration, $method)
    {
        if (!isset($configuration->methods[$method])) {
            return;
        }

        $fields = '';
        if ($configuration->methods[$method]['idempotency']) {
            $fields = $this->_getIdempotencyAttributes($configuration->attributes);
        }

        if ($fields != '') {
            $query['headers']['x-idempotency-key'] = hash(self::$CIPHER, $fields);
        }
    }

    /**
     * @param $attributes
     *
     * @return string
     */
    protected function _getIdempotencyAttributes($attributes)
    {
        $result = [];
        foreach ($attributes as $key => $value) {
            if ($value['idempotency']) {
                $result[] = $key;
            }
        }

        return implode('&', $result);
    }
}