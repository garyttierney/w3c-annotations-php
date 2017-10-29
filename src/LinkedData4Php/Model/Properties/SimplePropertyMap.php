<?php

namespace LinkedData4Php\Model\Properties;

final class SimplePropertyMap extends PropertyMap
{
    /**
     * @var array
     */
    private $properties;

    public function __construct(array $properties = [])
    {
        $this->properties = $properties;
    }

    public function getProperty(string $term)
    {
        return $this->properties[$term];
    }

    public function setProperty(string $term, $value)
    {
        $this->properties[$term] = $value;
    }

    public function hasProperty(string $term)
    {
        return isset($this->properties[$term]);
    }
}
