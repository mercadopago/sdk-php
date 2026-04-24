<?php

namespace MercadoPago\Serialization;

/**
 * Provides nested-object deserialization support for resource DTOs.
 *
 * Classes that use this trait declare a mapping from JSON field names
 * to PHP class names via {@see getMap()}. The {@see Serializer} uses
 * this mapping to recursively hydrate nested objects and collections.
 *
 * Example implementation:
 * ```php
 * public function getMap(): array
 * {
 *     return ['payer' => Payer::class, 'items' => Items::class];
 * }
 * ```
 */
trait Mapper
{
    /**
     * Resolves the PHP class name for a given JSON field, or null if unmapped.
     *
     * @param string $field JSON field name (e.g., "payer", "items").
     * @return class-string|null Fully-qualified class name, or null if the field has no mapping.
     */
    public function map(string $field)
    {
        $map = $this->getMap();
        return isset($map[$field]) ? $map[$field] : null;
    }

    /**
     * Returns the field-to-class mapping used by {@see Serializer} for nested deserialization.
     *
     * @return array<string,class-string> Map of JSON field names to their corresponding PHP class names.
     */
    abstract public function getMap(): array;
}
