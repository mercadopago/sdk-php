<?php
namespace MercadoPago;
use Doctrine\Common\Annotations\Reader;

class MetaData
{
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getMetaData($entity)
    {
        $result = new \stdClass;
        $class = new \ReflectionClass($entity);
        $classAnnotations = $this->reader->getClassAnnotations($class);

        foreach ($classAnnotations as $annotation) {
            if ($annotation instanceof \MercadoPago\Annotation\RestMethod) {
                $result->resource = $annotation->resource;
                $result->method = $annotation->method;
            }
        }


        return $result;
    }
}