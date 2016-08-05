<?php
namespace MercadoPago;
use Doctrine\Common\Annotations\Reader;

/**
 * MetaData Class Doc Comment
 *
 * @package MercadoPago
 */
class MetaData
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * MetaData constructor.
     *
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param $entity
     *
     * @return \stdClass
     */
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
            if ($annotation instanceof \MercadoPago\Annotation\RequestParam) {
                $result->params[] = $annotation->value;
            }
        }


        return $result;
    }
}