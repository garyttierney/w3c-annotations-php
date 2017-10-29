<?php

namespace LinkedData4Php\Model;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\DCTERMS;

interface CreationProvenance extends Resource
{
    /**
     * @Iri(DCTERMS::CREATOR, type=Agent::class)
     */
    public function getCreator(): ?Agent;

    /**
     * @Iri(DCTERMS::CREATOR, type=Agent::class)
     */
    public function setCreator(Agent $agent): void;
}
