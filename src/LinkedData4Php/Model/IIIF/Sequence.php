<?php

namespace LinkedData4Php\Model\IIIF;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\IIIFP;
use LinkedData4Php\Model\ResourceInterface;

/**
 * @Iri(IIIFP::SEQUENCE)
 */
interface Sequence extends ResourceInterface
{
    /**
     * @Iri(IIIFP::HAS_CANVASES, collection=true, type=Canvas::class)
     */
    public function getCanvases(): array;
}
