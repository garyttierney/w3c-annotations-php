<?php

namespace LinkedData4Php\Model\Ontology;

/**
 * Ontology class for the Friend of a Friend ontology (foaf:).
 * See <a href="http://xmlns.com/foaf/spec/">http://xmlns.com/foaf/spec/</a>.
 */
final class FOAF
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'http://xmlns.com/foaf/0.1/';

    /**
     * Textual prefix of the ontology.
     */
    const PREFIX = 'foaf';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_Person
     * The Person class represents people. Something is a Person if it is a person. We don't nitpic about whether they're alive, dead, real, or imaginary. The Person class is a sub-class of the Agent class, since all people are considered 'agents' in FOAF.
     */
    const PERSON = self::NS.'Person';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_Organization
     * The Organization class represents a kind of Agent corresponding to social instititutions such as companies, societies etc.
     */
    const ORGANIZATION = self::NS.'Organization';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_name
     * The name of something is a simple textual string.
     */
    const NAME = self::NS.'name';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_page
     * The page property relates a thing to a document about that thing.
     */
    const PAGE = self::NS.'page';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_mbox
     * personal mailbox - A personal mailbox, ie. an Internet mailbox associated with exactly one owner, the first owner of this mailbox. This is a 'static inverse functional property', in that there is (across time and change) at most one individual that ever has any particular value for foaf:mbox.
     */
    const MBOX = self::NS.'mbox';

    /**
     * Refers to http://xmlns.com/foaf/0.1/mbox_sha1sum.
     */
    const MBOX_SHA1SUM = self::NS.'mbox_sha1sum';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_openid
     * A openid is a property of a Agent that associates it with a document that can be used as an indirect identifier in the manner of the OpenID "Identity URL".
     */
    const OPEN_ID = self::NS.'openid';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_homepage
     * The homepage property relates something to a homepage about it.
     */
    const HOMEPAGE = self::NS.'homepage';

    /**
     * Refers to http://xmlns.com/foaf/spec/#term_nick
     * The nick is short informal nickname characterizing an agent (includes login identifiers, IRC and other chat nicknames.
     */
    const NICK = self::NS.'nick';
}
