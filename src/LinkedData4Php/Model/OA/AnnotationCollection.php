<?php

namespace LinkedData4Php\Model\OA;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\Ontology\ASO;

/**
 * @Iri(ASO::ORDERED_COLLECTION)
 */
interface AnnotationCollection
{
    /**
     * @Iri(ASO::FIRST)
     */
    public function getFirstPage(): AnnotationPage;

    /**
     * @Iri(ASO::LAST)
     */
    public function getLastPage(): AnnotationPage;

    /**
     * @Iri(ASO::TOTAL_ITEMS)
     */
    public function getTotal(): int;
}
