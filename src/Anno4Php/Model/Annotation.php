<?php

namespace Anno4Php\Model;

use Anno4Php\Model\Ontology\OADM;
use Anno4Php\Model\Traits\Resource;
use ML\JsonLD\Node;

/**
 * A W3C annotation.
 */
final class Annotation extends AbstractResource
{
    use Resource;

    /**
     * Get the motivation of this {@code Annotation} using the {@link OADM::MOTIVATED_BY} relationship.
     *
     * @return Node
     */
    public function getMotivation()
    {
        return $this->getProperty(OADM::MOTIVATED_BY);
    }

    /**
     * Get a collection of {@link Body}s from this {@code Annotation} using the {@link OADM::HAS_BODY} relationship.
     *
     * @return Node[]
     */
    public function getBodies()
    {
        return $this->getCollectionProperty(OADM::HAS_BODY);
    }

    /**
     * Get a collection of {@link Target}s from this {@code Annotation} using the {@link OADM::HAS_TARGET} relationship.
     *
     * @return Node[]
     */
    public function getTargets()
    {
        return $this->getCollectionProperty(OADM::HAS_TARGET);
    }
}
