<?php

namespace LinkedData4Php\Model\Ontology;

/**
 * Ontology class for the schema.org vocabulary.
 *
 * @see <a href="http://schema.org/</a>
 */
class SCHEMA
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'https://schema.org/';

    /**
     * Textual prefix of the ontology.
     */
    const PREFIX = 'schema';

    /**
     * Refers to http://schema.org/Audience
     * Intended audience for an item, i.e. the group for whom the item was created.
     */
    const AUDIENCE_CLASS = self::NS.'Audience';

    /**
     * Refers to http://schema.org/audience
     * An intended audience, i.e. a group for whom something was created.
     */
    const AUDIENCE_RELATIONSHIP = self::NS.'audience';
}
