<?php

namespace Anno4Php\Model;

use Anno4Php\Model\Ontology\FOAF;
use Anno4Php\Model\Traits\Resource;

final class Agent extends AbstractResource
{
    use Resource;

    /**
     * Get the label of this {@code Agent} using {@link FOAF::NAME}.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getProperty(FOAF::NAME);
    }

    /**
     * Set the label of this {@code Agent}'s {@link FOAF::NAME} property.
     *
     * @param string $newName
     */
    public function setName(string $newName)
    {
        $this->getNode()->setProperty(FOAF::NAME, $newName);
    }
}
