<?php

namespace LinkedData4Php\Metadata;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\ResourceInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use LinkedData4Php\Model\SimpleResource;

class ResourceMetadataFactory
{
    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    public function __construct(AnnotationReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function create(string $type): ResourceMetadata
    {
        $class = new \ReflectionClass($type);
        $iri = $this->annotationReader->getClassAnnotation($class, Iri::class);

        if (null === $iri) {
            throw new \InvalidArgumentException("$type is not marked with the LinkedData4Php\Annotations\Iri annotation");
        }

        /** @var \ReflectionClass[] $allSuperTypes */
        $superTypes = $class->getInterfaceNames();
        $properties = [];

        foreach ($class->getMethods() as $method) {
            $methodName = $method->getName();
            $declaringClass = $method->getDeclaringClass();
            $declaringClassName = $declaringClass->getName();

            if (ResourceInterface::class === $declaringClassName) {
                continue;
            }

            $methodIri = $this->annotationReader->getMethodAnnotation($method, Iri::class);
            if (null === $methodIri) {
                throw new \InvalidArgumentException(
                    'Found a method named '.$methodName.' in '.$declaringClassName.' with no Iri annotation'
                );
            }

            if (isset($properties[$methodIri->value])) {
                continue;
            }

            $methodName = $method->getName();
            $methodPrefix = substr($methodName, 0, 3);

            if (!in_array($methodPrefix, ['add', 'set', 'get'])) {
                throw new \InvalidArgumentException("Invalid method prefix: $methodPrefix");
            }

            $valueType = $methodIri->type ?: SimpleResource::class;

            if (true === $methodIri->collection) {
                $propertyType = ResourcePropertyType::COLLECTION;
            } elseif (in_array($valueType, ['string', 'bool', 'int', 'id'])) {
                $propertyType = ResourcePropertyType::SCALAR;
            } else {
                $propertyType = ResourcePropertyType::RESOURCE;
            }

            $properties[$methodIri->value] = new ResourcePropertyMetadata(
                $methodIri->value,
                $propertyType,
                $valueType
            );
        }

        return new ResourceMetadata($iri->value, $class->getName(), $properties, $superTypes);
    }
}
