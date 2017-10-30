<?php

namespace LinkedData4Php\Model\IIIF;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\IIIFP;
use LinkedData4Php\Model\ResourceInterface;

/**
 * @Iri(IIIFP::MANIFEST)
 */
interface Manifest extends ResourceInterface
{
    /**
     * @Iri(IIIFP::HAS_SEQUENCES, collection=true, type=Sequence::class)
     */
    public function getSequences(): array;

    /**
     * @Iri(IIIFP::VIEWING_HINT, type="string")
     */
    public function getViewingHint(): ?string;

    /**
     * @Iri(IIIFP::VIEWING_DIRECTION, type="string")
     */
    public function getViewingDirection(): ?string;
}
