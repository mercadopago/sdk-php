<?php

namespace MercadoPago\Serialization;

use MercadoPago\Net\MPResource;

/** Serializer class, responsible for objects serialization and deserialization. */
class Serializer
{
    /**
     * Method responsible for deserialize objects.
     * @param mixed $entity entity to be deserialized.
     * @param mixed $data data to be deserialized.
     * @return \MercadoPago\Net\MPResource deserialized object.
     */
    public static function deserializeFromJson(mixed $entity, mixed $data): MPResource
    {
        return self::_deserializeFromJson($entity, $data);
    }

    private static function _deserializeFromJson(mixed $entity, mixed $data): object|null
    {
        if (!$data) {
            return null;
        }

        $object = new $entity();

        foreach ($data as $key => $value) {
            if (!is_null($value) && !empty($value) && is_array($value) && method_exists($object, "map")) {
                $class_name = $object->map($key);
                if (!is_null($class_name) && class_exists($class_name, true)) {
                    if (is_array($value) && is_numeric(key($value))) {
                        $deserialized_values = [];
                        foreach ($value as $item) {
                            $deserialized_values[] = self::_deserializeFromJson($class_name, $item);
                        }
                        $object->$key = $deserialized_values;
                    } else {
                        $object->$key = self::_deserializeFromJson($class_name, $value);
                    }
                }
            } elseif (property_exists($object, $key)) {
                $object->{$key} = $value;
            }
        }

        return $object;
    }
}
