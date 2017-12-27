<?php
namespace MercadoPago;
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
    private $_customTrackingParams=array();
    
    private $_entityConfiguration;
    /**
     * @var MetaDataReader
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
        $this->_metadataReader = new MetaDataReader();
    }
    protected function _getEntityConfiguration($entity)
    {
        $className = $this->_getEntityClassName($entity);
        if (isset($this->_entityConfiguration[$className])) {
            return $this->_entityConfiguration[$className];
        }
        $this->_entityConfiguration[$className] = $this->_metadataReader->getMetaData($entity);
        return $this->_entityConfiguration[$className];
    }
    
    /** 
     * @param string $method
     * @param null   $parameters
     *
     * @return mixed
     */
    public function simple_execute($method)
    {
      
    }
      
      
    public function addCustomTrackingParam($key, $value)
    {
      $this->_customTrackingParams[$key] = $value;
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
        $configuration = $this->_getEntityConfiguration($entity);
        foreach ($configuration->attributes as $key => $attribute) {
            $this->validateAttribute($entity, $key, ['required']);
        }
        $this->_setDefaultHeaders($configuration->query);
        $this->_setCustomHeaders($entity, $configuration->query);
        $this->_setIdempotencyHeader($configuration->query, $configuration, $method);
        $this->setQueryParams($entity);
         
          
        return $this->_client->{$method}($configuration->url, $configuration->query);
    }
    public function validateAttribute($entity, $attribute, array $properties, $value = null)
    {
        $configuration = $this->_getEntityConfiguration($entity);
        foreach ($properties as $property) {
            if ($configuration->attributes[$attribute][$property]) {
                $result = $this->_isValidProperty($attribute, $property, $entity, $configuration->attributes[$attribute], $value);
                if (!$result) {
                    throw new \Exception('Error ' . $property . ' in attribute ' . $attribute);
                }
            }
        }
    }
    protected function _isValidProperty($key, $property, $entity, $attribute, $value)
    {
        switch ($property) {
            case 'required':
                return ($entity->{$key} !== null);
            case 'maxLength':
                return (strlen($value) <= $attribute['maxLength']);
            case 'readOnly':
                return !$attribute['readOnly'];
        }
        return true;
    }
    /**
     * @param $entity
     * @param $ormMethod
     *
     * @throws \Exception
     */
    public function setEntityUrl($entity, $ormMethod, $params = [])
    {
        $className = $this->_getEntityClassName($entity);
        if (!isset($this->_entityConfiguration[$className]->methods[$ormMethod])) {
            throw new \Exception('ORM method ' . $ormMethod . ' not available for entity:' . $className);
        }
        $url = $this->_entityConfiguration[$className]->methods[$ormMethod]['resource'];
        
        $matches = [];
        preg_match_all('/\\:\\w+/', $url, $matches);
        
        foreach ($matches[0] as $match) {
          
          $key = substr($match, 1);
          if (array_key_exists($key, $params)) {
              $url = str_replace($match, $params[$key], $url);
          } else {
              $url = str_replace($match, $entity->{$key}, $url);
          }
        } 
        $this->_entityConfiguration[$className]->url = $url;
    }
    /**
     * @param $entity
     *
     * @return mixed
     */
    public function setEntityMetadata($entity)
    {
        return $this->_getEntityConfiguration($this->_getEntityClassName($entity));
    }
    /**
     * @param $entity
     *
     * @return string
     */
    protected function _getEntityClassName($entity)
    {
        if (is_object($entity)) {
            $className = get_class($entity);
        } else {
            $className = $entity;
        }
        return $className;
    }
    /**
     * @param $entity
     */
    public function setEntityQueryJsonData($entity)
    {
        $className = $this->_getEntityClassName($entity);
        $result = [];
        $this->_attributesToJson($entity, $result, $this->_entityConfiguration[$className]);
        $this->_entityConfiguration[$className]->query['json_data'] = json_encode($result);
    }
    public function setRawQueryJsonData($entity, $data)
    {
      $className = $this->_getEntityClassName($entity);
      $this->_entityConfiguration[$className]->query['json_data'] = json_encode($data);
    }
    
    /**
     * @param $entity
     */
    public function setEntityDeltaQueryJsonData($entity)
    {
        $className = $this->_getEntityClassName($entity);
        $result = [];
        $this->_deltaToJson($entity, $result, $this->_entityConfiguration[$className]);
        $this->_entityConfiguration[$className]->query['json_data'] = json_encode($result);
    }
    /**
     * @param $configuration
     */
    public function setQueryParams($entity, $urlParams = [])
    {
        $configuration = $this->_getEntityConfiguration($entity);
        $params = [];
        
        if (!isset($configuration->query) || !isset($configuration->query['url_query'])) {
            $configuration->query['url_query'] = $params;
        }
        if (isset($configuration->params)) {
            foreach ($configuration->params as $value) {
                $params[$value] = $this->_config->get(strtoupper($value));
            }
            if (count($params) > 0) {
                $arrayMerge = array_merge($urlParams, $params, $configuration->query['url_query']);
                $configuration->query['url_query'] = $arrayMerge;
            }
        }
        //var_dump($configuration);
    }
    /**
     * @param $entity
     * @param $result
     * @param $configuration
     */
    protected function _attributesToJson($entity, &$result)
    {
      $specialAttributes = array("_last");  
      if (is_array($entity)) {             
          $attributes = array_filter($entity); 
      } else { 
          $attributes = $entity->toArray();
      }
      
       foreach ($attributes as $key => $value) {
           if ($value instanceof Entity || is_array($value)) {
               $this->_attributesToJson($value, $result[$key]);
           } else {
             if ($value != null){
               $result[$key] = $value;
             } 
           } 
       } 
    }
    /**
     * @param $entity
     * @param $result
     * @param $configuration
     */
    protected function _deltaToJson($entity, &$result){
        $specialAttributes = array("_last"); // TODO: Refactor this
        if (!is_array($entity)) {            // TODO: Refactor this
            $attributes = array_filter($entity->toArray());
        } else {
            $attributes = $entity;
        }

        foreach ($attributes as $key => $value) {
            if (!in_array($key, $specialAttributes)){
                if ($value instanceof Entity || is_array($value)) {
                    //$this->_deltaToJson($value, $result[$key]);
                } else {
                    $last = $entity->_last;
                    $last_value = $last->$key;
                    if ($last_value != $value){
                        $result[$key] = $value;
                    }
                }

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
    /**
     * @param $entity
     *
     * @return bool
     */
    public function getDynamicAttributeDenied($entity)
    {
        $metaData = $this->_getEntityConfiguration($entity);
        return isset($metaData->denyDynamicAttribute);
    }
    
    /**
     * @param $query
     */
    protected function _setCustomHeaders(&$entity, &$query)
    { 
        foreach ($entity::getCustomHeaders() as $key => $value){ 
            $query['headers'][$key] = $value;
        }
    }
    
   
    /**
     * @param $query
     */
    protected function _setDefaultHeaders(&$query)
    {
        $query['headers']['Accept'] = 'application/json';
        $query['headers']['Content-Type'] = 'application/json';
        $query['headers']['User-Agent'] = 'Mercado Pago Php SDK v' . Version::$_VERSION;
        foreach ($this->_customTrackingParams as $key => $value){ 
            $query['headers'][$key] = $value;
        }
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