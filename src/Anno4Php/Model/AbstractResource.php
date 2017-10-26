<?php

namespace Anno4Php\Model;

use ML\JsonLD\Node;

abstract class AbstractResource
{
    /**
     * @var Node
     */
    private $node;

    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * Get the RDF node representing this {@link Resource}.  Will dereference the {@link Node}'s {@link IRI} if not already
     * dereferenced.
     *
     * @return Node
     */
    final protected function getNode(): Node
    {
        return $this->node;
    }
}
