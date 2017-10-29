<?php

namespace LinkedData4Php\Model\Ontology;

final class DCTERMS
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'http://purl.org/dc/terms/';

    /**
     * Textual prefix of the ontology.
     */
    const PREFIX = 'dcterms';

    /**
     * Refers to http://dublincore.org/documents/dcmi-terms/#terms-conformsTo
     * An established standard to which the described resource conforms.
     */
    const CONFORMS_TO = self::NS.'conformsTo';

    const FORMAT = self::NS.'format';

    /**
     * Refers to http://purl.org/dc/terms/creator.
     */
    const CREATOR = self::NS.'creator';

    /**
     * Refers to http://purl.org/dc/terms/rights.
     */
    const RIGHTS = self::NS.'rights';

    /**
     * Refers to http://purl.org/dc/terms/created.
     */
    const CREATED = self::NS.'created';

    /**
     * Refers to http://purl.org/dc/terms/modified.
     */
    const MODIFIED = self::NS.'modified';

    /**
     * Refers to http://purl.org/dc/terms/issued.
     */
    const ISSUED = self::NS.'issued';
}
