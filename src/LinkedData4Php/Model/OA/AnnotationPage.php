<?php

namespace LinkedData4Php\Model\OA;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\ASO;
use LinkedData4Php\Model\ResourceInterface;

interface AnnotationPage extends ResourceInterface
{
    /**
     * @Iri(ASO::PART_OF)
     */
    public function getPartOf(): AnnotationCollection;

    /**
     * @Iri(ASO::ITEMS)
     */
    public function getItems(): array;

    /**
     * @Iri(ASO::NEXT)
     */
    public function getNext(): AnnotationPage;

    /**
     * @Iri(ASO::PREV)
     */
    public function getPrevious(): AnnotationPage;

    /**
     * @Iri(ASO::TOTAL_ITEMS)
     */
    public function getTotalItems(): int;

    /**
     * @Iri(ASO::START_INDEX)
     */
    public function getStartIndex(): int;
}
