<?php

namespace LinkedData4Php\Model\Ontology;

/**
 * Ontology class for the activity streams vocabulary.
 *
 * @see <a href="https://www.w3.org/TR/activitystreams-vocabulary/</a>
 */
final class ASO
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'http://www.w3.org/ns/activitystreams#';

    /**
     * Textual prefix of the ontology.
     */
    const PREFIX = 'as';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#Application
     * Describes a software application.
     */
    const APPLICATION = self::NS.'Application';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#OrderedCollection
     * A subclass of Collection in which members of the logical collection are assumed to always be strictly ordered.
     */
    const ORDERED_COLLECTION = self::NS.'OrderedCollection';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#OrderedCollectionPage
     * Used to represent ordered subsets of items from an OrderedCollection. Refer to the Activity Streams 2.0 Core for
     * a complete description of the OrderedCollectionPage object.
     */
    const ORDERED_COLLECTION_PAGE = self::NS.'OrderedCollectionPage';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#generator.
     */
    const GENERATOR = self::NS.'generator';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#items.
     */
    const ITEMS = self::NS.'items';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#partOf.
     */
    const PART_OF = self::NS.'partOf';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#first.
     */
    const FIRST = self::NS.'first';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#last.
     */
    const LAST = self::NS.'last';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#next.
     */
    const NEXT = self::NS.'next';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#prev.
     */
    const PREV = self::NS.'prev';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#totalItems.
     */
    const TOTAL_ITEMS = self::NS.'totelItems';

    /**
     * Refers to http://www.w3.org/ns/activitystreams#startIndex.
     */
    const START_INDEX = self::NS.'startIndex';
}
