<?php
namespace MercadoPago;
/**
 * Class Entity
 *
 * @package MercadoPago
 */
abstract class Entity
{
    /**
     * @var
     */
    
    protected static $_custom_headers = array();
    protected static $_manager;
    protected $_last;
    /**
     * Entity constructor.
     *
     * @param array $params
     *
     * @throws \Exception
     */
    public function __construct($params = [])
    {
        if (empty(self::$_manager)) {
            throw new \Exception('Please initialize SDK first');
        }
        self::$_manager->setEntityMetaData($this);
        $this->_fillFromArray($this, $params);
    }
    /**
     * @param Manager $manager
     */
    public static function setManager(Manager $manager)
    {
        self::$_manager = $manager;
    }
    /**
     */
    public static function unSetManager()
    {
        self::$_manager = null;
    }
    /**
     * @return mixed
     */
    public static function get($id)
    {
      self::read(array("id" => $id));
    }
    /**
     * @return mixed
     */
    public static function find_by_id($id)
    { 
      return self::read(array("id" => $id));
    }
    public static function setCustomHeader($key, $value)
    {
      self::$_custom_headers[$key] = $value;
    } 
    public static function getCustomHeader($key)
    {
      return self::$_custom_headers[$key];
    } 
    public static function setCustomHeadersFromArray($array){
      foreach ($array as $key => $value){ 
        self::setCustomHeader($key, $value);
      } 
    }
    public static function getCustomHeaders()
    {
      return self::$_custom_headers;
    }
    /**
     * @return mixed
     */
    public static function read($params = [])
    {
       
      
      
      $class = get_called_class();
      $entity = new $class();

      self::$_manager->setEntityUrl($entity, 'read', $params);
      self::$_manager->setQueryParams($entity, $params); 
      
      $response =  self::$_manager->execute($entity, 'get');
      
      if ($response['code'] == "200" || $response['code'] == "201") {   
        $entity->_fillFromArray($entity, $response['body']);
      }
       
      $entity->_last = clone $entity;
      return $entity;
    }
    /**
     * @return mixed
     */
    public static function search($filters)
    {
      $class = get_called_class();
      
      $entity = new $class();
      
      self::$_manager->setEntityUrl($entity, 'search');
      self::$_manager->setQueryParams($entity, $filters);
      $response = self::$_manager->execute($entity, 'get');

      if ($response['code'] == "200" || $response['code'] == "201") {
          $entity->_fillFromArray($entity, $response['body']['results'][0]);
      }   
      return $entity;
    }
    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public function APCIteratorAll()
    {
        self::$_manager->setEntityUrl($this, 'list');
        return self::$_manager->execute($this, 'get');
    }
    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public static function addNew()
    {
        //return self::$_manager->execute(get_called_class(), '');
    }
    /**
     * @return mixed
     */
    public function update($params = [])
    {
        self::$_manager->setEntityUrl($this, 'update', $params);
        self::$_manager->setEntityDeltaQueryJsonData($this); 
        

        $response =  self::$_manager->execute($this, 'put');

        if ($response['code'] == "200" || $response['code'] == "201") {
            $this->_fillFromArray($this, $response['body']);
        }
        return $this;
    }
    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public static function destroy()
    {
        //return self::$_manager->execute(get_called_class(), '');
    }
    /**
     * @param $params
     *
     * @return mixed
     */
    public static function create($params)
    {
        $class = get_called_class();
        $model = new $class($params);
        $model->save();
        return $model;
    }
    /**
     * @return mixed
     */
    public function custom_action($method, $action)
    {
      self::$_manager->setEntityUrl($this, $action);
      self::$_manager->setEntityQueryJsonData($this);
      $response = self::$_manager->execute($this, $method);
      if ($response['code'] == "200" || $response['code'] == "201") {
          $this->_fillFromArray($this, $response['body']);
      }
      return $response;
    }
    /**
     * @return mixed
     */
    public function save()
    { 
      
      
      self::$_manager->setEntityUrl($this, 'create');
      self::$_manager->setEntityQueryJsonData($this);
      
      $response = self::$_manager->execute($this, 'post');
      if ($response['code'] == "200" || $response['code'] == "201") {
          $this->_fillFromArray($this, $response['body']);
      }
      return $response;
    }
    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }
    /**
     * @param $name
     * @param $value
     *
     * @return mixed
     * @throws \Exception
     */
    public function __set($name, $value)
    {
        $this->_setValue($name, $value);
        return $this->{$name};
    }
    /**
     * @param null $attributes
     *
     * @return array
     */
    public function toArray($attributes = null)
    {
        if (is_null($attributes)) {
            return get_object_vars($this);
        }
        return array_intersect_key(get_object_vars($this), $attributes);
    }
    /**
     * @param $property
     * @param $value
     *
     * @throws \Exception
     */
    protected function _setValue($property, $value, $validate = true)
    {
        if ($this->_propertyExists($property)) {
            if ($validate) {
                self::$_manager->validateAttribute($this, $property, ['maxLength','readOnly'], $value);
            }
            if ($this->_propertyTypeAllowed($property, $value)) {
                $this->{$property} = $value;
            } else {
                $this->{$property} = $this->tryFormat($value, $this->_getPropertyType($property), $property);
            }
        } else {
            if ($this->_getDynamicAttributeDenied()) {
                throw new \Exception('Dynamic attribute: ' . $property . ' not allowed for entity ' . get_class($this));
            }
            $this->{$property} = $value;
        }
    }
    /**
     * @param $property
     *
     * @return bool
     */
    protected function _propertyExists($property)
    {
        return array_key_exists($property, get_object_vars($this));
    }
    /**
     * @param $property
     * @param $type
     *
     * @return bool
     */
    protected function _propertyTypeAllowed($property, $type)
    {
        $definedType = $this->_getPropertyType($property);
        if (!$definedType) {
            return true;
        }
        if (is_object($type) && class_exists($definedType, false)) {
            return ($type instanceof $definedType);
        }
        return gettype($type) == $definedType;
    }
    /**
     * @param $property
     *
     * @return mixed
     */
    protected function _getPropertyType($property)
    {
        return self::$_manager->getPropertyType(get_called_class(), $property);
    }
    /**
     * @return mixed
     */
    protected function _getDynamicAttributeDenied()
    {
        return self::$_manager->getDynamicAttributeDenied(get_called_class());
    }
    /**
     * @param $value
     * @param $type
     * @param $property
     *
     * @return array|bool|float|int|string
     * @throws \Exception
     */
    protected function tryFormat($value, $type, $property)
    {
        try {
            switch ($type) {
                case 'float':
                    if (!is_numeric($value)) {
                        break;
                    }
                    return (float)$value;
                case 'int':
                    if (!is_numeric($value)) {
                        break;
                    }
                    return (int)$value;
                case 'string':
                    return (string)$value;
                case 'array':
                    return (array)$value;
                case 'date':
                    if (empty($value)) {
                        return $value;
                    }
                    return date(\DateTime::ISO8601, strtotime($value));
            }
        } catch (\Exception $e) {
            throw new \Exception('Wrong type ' . gettype($value) . '. Cannot convert ' . $type . ' for property ' . $property);
        }
        throw new \Exception('Wrong type ' . gettype($value) . '. It should be ' . $type . ' for property ' . $property);
    }
    /**
     * Fill entity from data with nested object creation
     *
     * @param $entity
     * @param $data
     */
    protected function _fillFromArray($entity, $data)
    { 
      
      if ($data) {
      
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $className = 'MercadoPago\\' . $this->_camelize($key);
                if (class_exists($className, true)) {
                    $entity->_setValue($key, new $className, false);
                    $entity->_fillFromArray($this->{$key}, $value);
                } else {
                    $entity->_setValue($key, json_decode(json_encode($value)), false);
                }
                continue;
            }
            $entity->_setValue($key, $value, false);
        }
      }
    }
    /**
     * @param        $input
     * @param string $separator
     *
     * @return mixed
     */
    protected function _camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }
}