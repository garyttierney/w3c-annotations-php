<?php

namespace Anno4Php\Model\Ontology;

/**
 * Ontology class for the <a href="http://dublincore.org/documents/dcmi-terms/">Dublin Core ontology (dc:)</a>.
 */
final class DC
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'http://purl.org/dc/elements/1.1/';

    /**
     * Textual prefix of the ontology.
     */
    const PREFIX = 'dc';

    /**
     * Refers to http://dublincore.org/documents/dcmi-terms/#terms-format
     * The file format, physical medium, or dimensions of the resource.
     */
    const FORMAT = self::NS.'format';

    /**
     * Refers to http://dublincore.org/documents/dcmi-terms/#terms-language
     * A language of the resource.
     */
    const LANGUAGE = self::NS.'language';
}
