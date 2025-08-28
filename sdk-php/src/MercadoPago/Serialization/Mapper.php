<?php

namespace MercadoPago\Serialization;

/**
 * Mapper trait.
 */
trait Mapper
{
    /**
     * Method responsible for return mapped class for entity filled.
     * @param string $field field to be mapped.
     * @return mixed mapped class.
     */
    public function map(string $field)
    {
        $map = $this->getMap();
        return isset($map[$field]) ? $map[$field] : null;
    }


    /**
     * Method responsible for getting map of entities.
     * @return array map of entities.
     */
    abstract public function getMap(): array;
}
