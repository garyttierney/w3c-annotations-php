<?php

namespace LinkedData4Php\Model;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\PROV;
use LinkedData4Php\Model\Ontology\FOAF;

/**
 * @Iri(PROV::AGENT)
 */
interface Agent extends ResourceInterface
{
    /**
     * @Iri(FOAF::NAME, type="string")
     */
    public function getName(): string;

    /**
     * @Iri(FOAF::HOMEPAGE, type="string")
     */
    public function getHomepage(): string;

    /**
     * @Iri(FOAF::NICK, type="string")
     */
    public function getNickname(): string;
}
