<?php
namespace MercadoPago;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * MetaDataReader Class Doc Comment
 *
 * @package MercadoPago
 */
class MetaDataReader
{
    /**
     * @var Reader
     */
    private $_reader;

    /**
     * MetaData constructor.
     *
     * @param Reader $reader
     */
    public function __construct()
    {
        AnnotationRegistry::registerLoader('class_exists');
        AnnotationRegistry::loadAnnotationClass('MercadoPago\\Annotation\\RestMethod');
        AnnotationRegistry::loadAnnotationClass('MercadoPago\\Annotation\\RequestParam');
        AnnotationRegistry::loadAnnotationClass('MercadoPago\\Annotation\\Attribute');
        AnnotationRegistry::loadAnnotationClass('MercadoPago\\Annotation\\DenyDynamicAttribute');

        $this->_reader = new AnnotationReader();
        
        return $this;

    }

    /**
     * @param $entity
     *
     * @return \stdClass
     */
    public function getMetaData($entity)
    {
        $propertyAnnotations = [];
        $result = new \stdClass;
        $class = new \ReflectionClass($entity);
        $classAnnotations = $this->_reader->getClassAnnotations($class);
        foreach ($class->getProperties() as $key => $value) {
            $annotation = $this->_reader->getPropertyAnnotations(new \ReflectionProperty($entity, $value->name));
            if (count($annotation)) {
                $propertyAnnotations[$value->name] = array_pop($annotation);
            }
        }

        foreach ($classAnnotations as $annotation) {
            if ($annotation instanceof \MercadoPago\Annotation\RestMethod) {
                $result->methods[$annotation->method] = get_object_vars($annotation);
            }
            if ($annotation instanceof \MercadoPago\Annotation\RequestParam) {
                $result->params[] = $annotation->param;
            }
            if ($annotation instanceof \MercadoPago\Annotation\DenyDynamicAttribute) {
                $result->denyDynamicAttribute = true;
            }
        }

        foreach ($propertyAnnotations as $key => $annotation) {
            if ($annotation instanceof \MercadoPago\Annotation\Attribute) {
                $result->attributes[$key] = get_object_vars($annotation);
            }
        }

        return $result;
    }
}