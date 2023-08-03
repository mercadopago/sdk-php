<?php

namespace MercadoPago\Serialization;

use MercadoPago\Net\MPResource;

use function PHPUnit\Framework\isNull;

/** Serializer class, responsible for objects serialization and deserialization. */
class Serializer
{
    /**
     * Method responsible for deserialize objects.
     * @param mixed $entity entity to be deserialized.
     * @param mixed $data data to be deserialized.
     * @return \MercadoPago\Net\MPResource deserialized object.
     */
    public static function deserializeFromJson($entity, $data): MPResource
    {
        return self::_deserializeFromJson($entity, $data);
    }

    private static function _deserializeFromJson($entity, $data)
    {
        if (!$data) {
            return null;
        }

        $object = new $entity();

        foreach ($data as $key => $value) {
            if (!is_null($value) && is_array($value) && !empty($value) && method_exists($object, "map")) {
                $class_name = $object->map($key);
                if (!IsNull($class_name) && class_exists($class_name, true)) {
                    $object->$key = self::_deserializeFromJson($class_name, $value);
                }
            } else {
                $object->{$key} = $value;
            }
        }

        return $object;
    }
}
