<?php

namespace LinkedData4Php\Metadata;

class ResourcePropertyMetadata
{
    /**
     * @var string
     */
    private $iri;
    /**
     * @var string
     */
    private $propertyType;
    /**
     * @var string
     */
    private $valueType;

    public function __construct(string $iri, string $propertyType, string $valueType)
    {
        $this->iri = $iri;
        $this->propertyType = $propertyType;
        $this->valueType = $valueType;
    }

    public function getValueType()
    {
        return $this->valueType;
    }

    public function getIri()
    {
        return $this->iri;
    }

    public function isCollection()
    {
        return ResourcePropertyType::COLLECTION === $this->propertyType;
    }

    public function isScalar()
    {
        return ResourcePropertyType::SCALAR === $this->propertyType;
    }
}
