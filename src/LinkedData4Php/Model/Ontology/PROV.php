<?php

namespace LinkedData4Php\Model\Ontology;

/**
 * Ontology class for <a href="http://www.w3.org/ns/prov#">PROV ontology (prov:)</a>.
 */
final class PROV
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'https://www.w3.org/ns/prov#';

    /**
     * Refers to https://www.w3.org/ns/prov#Agent
     * An agent is something that bears some form of responsibility for an activity taking place,
     * for the existence of an entity, or for another agent's activity.
     */
    const AGENT = self::NS.'Agent';
}
