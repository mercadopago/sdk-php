<?php

namespace MercadoPago;

use Symfony\Component\Config\Definition\Exception\Exception;

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

    /**
     * @param Manager $manager
     */
    public static function setManager(Manager $manager)
    {
        self::$_manager = $manager;
    }

    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public function loadAll()
    {
        self::$_manager->setEntityMetaData($this);
        self::$_manager->setEntityUrl($this, 'list');

        return self::$_manager->execute(get_called_class(), 'get');
    }

    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public static function load()
    {
        //return self::$_manager->execute(get_called_class(), 'get');
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
    public static function update()
    {
        //return self::$_manager->execute(get_called_class(), '');
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
     * @codeCoverageIgnore
     * @return mixed
     */
    public function save()
    {
        self::$_manager->setEntityMetaData($this);
        self::$_manager->setEntityUrl($this, 'save');
        self::$_manager->setEntityQueryJsonData($this);

        $response = self::$_manager->execute($this, 'post');
        if ($response['code'] == "200" || $response['code'] == "201") {
            self::$_manager->fillFromResponse($this, $response['body']);
        }

    }

    /**
     * @param $call
     * @param $arguments
     *
     * @return $this
     */
    public function __call($call, $arguments)
    {
        $name = $this->_underscore(substr($call, 3));
        switch (substr($call, 0, 3)) {
            case 'set' :
                $this->_setValue($name, array_shift($arguments));

                return $this;

            case 'get' :
                return $this->{$name};
        }
        throw new Exception("Invalid method " . get_class($this) . "::" . $call);

    }

    /**
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
     * @param $name
     *
     * @return string
     */
    protected function _underscore($name)
    {
        return strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
    }

    /**
     * @param $property
     * @param $value
     */
    protected function _setValue($property, $value)
    {
        if ($this->_propertyExists($property)) {
            if ($this->_propertyTypeAllowed($property, $value)) {
                $this->{$property} = $value;
            } else {
                $this->{$property} = $this->tryFormat($value, $this->_getPropertyType($property), $property);
            }
        }
        //TODO : check if dynamic attribute is allowed

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
     * @param $value
     * @param $type
     * @param $property
     *
     * @return bool|float|int|string
     */
    protected function tryFormat($value, $type, $property)
    {
        if (!is_object($value)) {
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
                case 'date':
                    return date(\DateTime::ISO8601, strtotime($value));
            }
        }

        throw new Exception('Wrong type ' . gettype($value) . '. It should be ' . $type . ' for property ' . $property);
    }

}