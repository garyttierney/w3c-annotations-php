<?php

namespace LinkedData4Php\Model\OA\Target;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\ResourceInterface;
use LinkedData4Php\Model\Ontology\OADM;

/**
 * @Iri(OADM::SPECIFIC_RESOURCE)
 */
interface SpecificResource extends Target
{
    /**
     * @Iri(OADM::HAS_SELECTOR)
     */
    public function getSelector(): ResourceInterface;

    /**
     * @Iri(OADM::HAS_SOURCE)
     */
    public function getSource(): ResourceInterface;

    /**
     * @Iri(OADM::HAS_SCOPE)
     */
    public function getScope(): ResourceInterface;

    /**
     * @Iri(OADM::STYLE_CLASS, collection=true, type="string")
     */
    public function getStyleClasses(): ResourceInterface;
}
