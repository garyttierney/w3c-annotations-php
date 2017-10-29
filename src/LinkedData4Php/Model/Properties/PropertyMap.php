<?php

namespace LinkedData4Php\Model\Properties;

abstract class PropertyMap implements \ArrayAccess
{
    public function offsetExists($offset)
    {
        return $this->hasProperty($offset);
    }

    public function offsetGet($offset)
    {
        return $this->getProperty($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->setProperty($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->setProperty($offset, null);
    }

    abstract public function hasProperty(string $term);

    abstract public function getProperty(string $term);

    abstract public function setProperty(string $term, $value);
}
