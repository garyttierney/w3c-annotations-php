<?php

namespace LinkedData4Php\Metadata;

class ResourceMetadata
{
    /**
     * @var string
     */
    private $iri;

    /**
     * @var string[]
     */
    private $superTypes;
    /**
     * @var string
     */
    private $class;
    /**
     * @var ResourcePropertyMetadata
     */
    private $properties;

    public function __construct(string $iri, string $class, array $properties, array $superTypes)
    {
        $this->iri = $iri;
        $this->class = $class;
        $this->properties = $properties;
        $this->superTypes = $superTypes;
    }

    public function hasPropertyMetadata($propertyName): bool
    {
        return isset($this->properties[$propertyName]);
    }

    public function getPropertyMetadata($propertyName): ResourcePropertyMetadata
    {
        return $this->properties[$propertyName];
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return $this->class;
    }

    /**
     * @return string
     */
    public function getIri(): string
    {
        return $this->iri;
    }

    /**
     * @return string[]
     */
    public function getSuperTypes(): array
    {
        return $this->superTypes;
    }
}
