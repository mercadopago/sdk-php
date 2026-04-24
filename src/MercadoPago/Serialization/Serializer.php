<?php

namespace MercadoPago\Serialization;

use MercadoPago\Net\MPResource;

/**
 * Hydrates resource DTOs from decoded JSON arrays returned by the MercadoPago API.
 *
 * Supports nested objects and collections via the {@see Mapper} trait.
 * When a resource class uses {@see Mapper::getMap()}, the serializer looks up
 * the target class for each nested key and recursively deserializes it.
 */
class Serializer
{
    /**
     * Creates and populates a resource instance from a decoded JSON associative array.
     *
     * Nested objects are resolved using the resource's {@see Mapper::map()} method.
     * Numeric-keyed arrays are treated as collections and each element is deserialized individually.
     *
     * @param class-string<MPResource> $entity Fully-qualified class name to instantiate.
     * @param array<string,mixed>|null $data   Decoded JSON body from {@see \MercadoPago\Net\MPResponse::getContent()}.
     * @return MPResource Fully-hydrated resource instance.
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
