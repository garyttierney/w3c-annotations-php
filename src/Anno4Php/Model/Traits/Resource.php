<?php

namespace Anno4Php\Model\Traits;

use Assert\Assertion;
use ML\IRI\IRI;
use ML\JsonLD\JsonLD;
use ML\JsonLD\Node;

/**
 * A resource in a linked data graph.  May be self-contained graph or an IRI that can be dereferenced using the
 * {@link DocumentLoaderInterface} the parent was loaded from.
 */
trait Resource
{
    /**
     * Get the {@link IRI} of this resource.
     *
     * @return IRI|null
     */
    final public function getId(): ?IRI
    {
        $id = $this->getNode()->getId();
        if (null !== $id) {
            $id = new IRI($id);
        }

        return $id;
    }

    /**
     * Serialize this {@code Resource} to a JSON string.
     *
     * @param bool $pretty pretty-print the JSON if true
     *
     * @return string a JSON encoded string
     */
    final public function toString(bool $pretty = false): string
    {
        return JsonLD::toString($this->getNode(), $pretty);
    }

    /**
     * Get the node representing this {@code Resource}.
     *
     * @return Node
     */
    abstract protected function getNode(): Node;

    /**
     * Get a generic property from this {@code Resource}.
     *
     * @param string $name
     *
     * @return Node
     */
    final protected function getProperty(string $name): Node
    {
        $property = $this->getNode()->getProperty($name);

        Assertion::notNull($property, 'No property found with the given name');
        Assertion::isObject($property, 'The requested property is a collection');

        return $property;
    }

    /**
     * Get a property of this {@code Resource} as a collection.
     *
     * @param string $name the term of the property to lookup
     *
     * @return array
     */
    final protected function getCollectionProperty(string $name): array
    {
        Assertion::notNull($property = $this->getNode()->getProperty($name), 'No property found with the given name');

        return is_array($property) ? $property : [$property];
    }
}
