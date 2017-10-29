<?php

namespace LinkedData4Php\Model\OA;

use LinkedData4Php\Annotations\Iri;
use LinkedData4Php\Model\OA\Body\Body;
use LinkedData4Php\Model\CreationProvenance;
use LinkedData4Php\Model\Agent;
use LinkedData4Php\Model\Ontology\ASO;
use LinkedData4Php\Model\Ontology\OADM;
use LinkedData4Php\Model\OA\Target\Target;

/**
 * A W3C annotation.
 *
 * @Iri(OADM::ANNOTATION)
 */
interface Annotation extends CreationProvenance
{
    /**
     * @Iri(ASO::GENERATOR, collection=false, type=Agent::class)
     */
    public function getGenerator(): ?Agent;

    /**
     * @Iri(ASO::GENERATOR, collection=false, type=Agent::class)
     */
    public function setGenerator(Agent $Agent): void;

    /**
     * @IRI(OADM::HAS_BODY, collection=true, type=Body::class)
     */
    public function addBody(Body $body): void;

    /**
     * @Iri(OADM::HAS_BODY, collection=true, type=Body::class)
     */
    public function getBodies(): array;

    /**
     * @Iri(OADM::HAS_BODY, collection=true, type=Body::class)
     */
    public function setBodies(Body ...$bodies): void;

    /**
     * @Iri(OADM::HAS_TARGET, collection=true, type=Target::class)
     */
    public function addTarget(Target $target): void;

    /**
     * @Iri(OADM::HAS_TARGET, collection=true, type=Target::class)
     */
    public function getTargets(): array;

    /**
     * @Iri(OADM::HAS_TARGET, collection=true, type=Target::class)
     */
    public function setTargets(Target ...$targets): void;

    /**
     * @Iri(OADM::MOTIVATED_BY, type=Motivation::class)
     */
    public function getMotivation(): Motivation;
}
