<?php

namespace MercadoPago;

/**
 * Entity Class Doc Comment
 *
 * @package MercadoPago
 */
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

    public function __construct()
    {
        if (empty(self::$_manager)) {
            throw new \Exception('Please initialize library first');
        }
    }

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
     */
    protected function _setValue($property, $value)
    {
        if ($this->_propertyExists($property)) {
            if ($this->_propertyTypeAllowed($property, $value)) {
                $this->{$property} = $value;
            } else {
                $this->{$property} = $this->tryFormat($value, $this->_getPropertyType($property), $property);
            }
        } else {
            if ($this->_getDynamicAttributeDenied()) {
                throw new \Exception('Dynamic attribute not allowed for entity');
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

        throw new \Exception('Wrong type ' . gettype($value) . '. It should be ' . $type . ' for property ' . $property);
    }

}