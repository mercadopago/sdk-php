<?php

namespace MercadoPago;

/**
 * Entity Class Doc Comment
 *
 * @package MercadoPago
 */
abstract class Entity
{
    /**
     * @var
     */
    protected static $_manager;

    public function __construct($params = [])
    {
        if (empty(self::$_manager)) {
            throw new \Exception('Please initialize SDK first');
        }
        self::$_manager->setEntityMetaData($this);
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
     * @codeCoverageIgnore
     * @return mixed
     */
    public function loadAll()
    {
        self::$_manager->setEntityUrl($this, 'list');
        return self::$_manager->execute($this, 'get');
    }

    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public function load($urlParams = [])
    {
        self::$_manager->setEntityUrl($this, 'load');
        self::$_manager->setQueryParams($this, $urlParams);
        self::$_manager->setEntityQueryJsonData($this);


        $response = self::$_manager->execute($this, 'get');
        if ($response['code'] == "200" || $response['code'] == "201") {
            self::$_manager->fillFromResponse($this, $response['body']['results'][0]);
        }

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
     * @codeCoverageIgnore
     * @return mixed
     */
    public function update()
    {
        //self::$_manager->setEntityUrl($this, 'update');
        //return self::$_manager->execute($this, 'put');
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
     * @codeCoverageIgnore
     * @return mixed
     */
    public function create()
    {
        //return self::$_manager->execute($this, 'post');
    }

    /**
     * @return mixed
     */
    public function save()
    {
        self::$_manager->setEntityUrl($this, 'save');
        self::$_manager->setEntityQueryJsonData($this);

        $response = self::$_manager->execute($this, 'post');
        if ($response['code'] == "200" || $response['code'] == "201") {
            self::$_manager->fillFromResponse($this, $response['body']);
        }

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
    protected function _setValue($property, $value)
    {
        if ($this->_propertyExists($property)) {
            self::$_manager->validateAttribute($this, $property, ['maxLength','readOnly'], $value);

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

        if (is_object($type) && class_exists($definedType)) {
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
                    return date(\DateTime::ISO8601, strtotime($value));
            }
        } catch (\Exception $e) {
            throw new \Exception('Wrong type ' . gettype($value) . '. Cannot convert ' . $type . ' for property ' . $property);
        }

        throw new \Exception('Wrong type ' . gettype($value) . '. It should be ' . $type . ' for property ' . $property);

    }

}