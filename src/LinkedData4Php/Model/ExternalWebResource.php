<?php

namespace LinkedData4Php\Model;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\OADM;
use LinkedData4Php\Model\Ontology\DC;

interface ExternalWebResource extends CreationProvenance
{
    /**
     * @Iri(OADM::PROCESSING_LANGUAGE, type="string")
     */
    public function getProcessingLanguage(): string;

    /**
     * @Iri(DC::LANGUAGE, collection=true, type="string")
     */
    public function getLanguages(): array;

    /**
     * @Iri(OADM::TEXT_DIRECTION, type=SimpleResource::class)
     */
    public function getTextDirection(): ResourceInterface;
}
