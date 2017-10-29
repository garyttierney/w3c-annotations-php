<?php

namespace LinkedData4Php\Model;

use LinkedData4Php\Model\Properties\PropertyMap;
use ML\IRI\IRI;

class SimpleResource implements ResourceInterface
{
    /**
     * @var PropertyMap
     */
    protected $properties;
    /**
     * @var IRI|null
     */
    private $id;
    /**
     * @var string
     */
    private $type;

    public function __construct(?IRI $id, ?string $type, PropertyMap $propertyMap)
    {
        $this->id = $id;
        $this->type = $type;
        $this->properties = $propertyMap;
    }

    final public function getId(): ?IRI
    {
        return $this->id;
    }

    final public function getType(): ?string
    {
        return $this->type;
    }

    final public function getProperties(): PropertyMap
    {
        return $this->properties;
    }
}
