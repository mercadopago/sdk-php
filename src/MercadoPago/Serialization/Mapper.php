<?php

namespace MercadoPago\Serialization;

/**
 * Mapper trait. 
 */
trait Mapper
{
    /**
     * Method responsible for return mapped class for entity filed.
     */
    public function map(string $field)
    {
        foreach ($this->getMap() as $key => $value) {
            if ($key === $field) {
                return $value;
            }
        }
    }

    /**
     * Method responsible for getting map of entities.
     */
    abstract public function getMap(): array;
}
