<?php

namespace LinkedData4Php\Model;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\FOAF;

/**
 * @Iri(FOAF::PERSON)
 */
interface Person extends Agent
{
    /**
     * @Iri(FOAF::OPEN_ID)
     */
    public function getOpenId(): ?string;
}
