<?php

namespace LinkedData4Php\Model\Ontology;

/**
 * Ontology class for the <a href="http://iiif.io/api/presentation/2.0/">IIIF Presentation API</a>.
 */
class IIIFP
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'http://iiif.io/api/presentation/2#';

    /**
     * Class for IIIF Canvas presentations. The canvas represents an individual page or view and acts as a central
     * point for laying out the different content resources that make up the display. Canvases must be identified by a
     * URI and it must be an HTTP(s) URI. If following the recommended URI pattern, the {name} parameter must uniquely
     * distinguish the canvas from all other canvases in the object. As with sequences, the name should not begin with
     * a number. Suggested patterns are “f1r” or “p1”.
     */
    const CANVAS = self::NS.'Canvas';

    /**
     * Class for IIIF Sequence presentations.  The sequence conveys the ordering of the views of the object. The
     * default sequence (and typically the only sequence) must be embedded within the manifest, and may also be
     * available from its own URI. The default sequence may have a URI to identify it. Any additional sequences must be
     * referred to from the manifest, not embedded within it, and thus these additional sequences must have an HTTP
     * URI.
     */
    const SEQUENCE = self::NS.'Sequence';

    /**
     * Class for IIIF Manifest presentations. The manifest resource represents a single object and any intellectual
     * work or works embodied within that object. In particular it includes the descriptive, rights and linking
     * information for the object. It then embeds the sequence(s) of canvases that should be rendered to the user.
     */
    const MANIFEST = self::NS.'Manifest';

    /**
     * A list of {@code CANVAS} objects contained within a {@code SEQUENCE}.
     */
    const HAS_CANVASES = self::NS.'hasCanvases';

    /**
     * A list of {@code SEQUENCE} objects contained within a {@code MANIFEST}.
     */
    const HAS_SEQUENCES = self::NS.'hasSequences';

    /**
     * Property representing the view direction of a {@code MANIFEST}.
     */
    const VIEWING_DIRECTION = self::NS.'viewingDirection';

    /**
     * The object is read from right to left.
     */
    const VIEWING_DIRECTION_RTL = self::NS.'rightToLeftDirection';

    /**
     * The object is read from left to right, and is the default if not specified.
     */
    const VIEWING_DIRECTION_LTR = self::NS.'leftToRightDirection';

    /**
     * The object is read from the top to the bottom.
     */
    const VIEWING_DIRECTION_TTB = self::NS.'leftToRightDirection';

    /**
     * The object is read from the bottom to the top.
     */
    const VIEWING_DIRECTION_BTT = self::NS.'leftToRightDirection';

    /**
     * A hint to the client as to the most appropriate method of displaying the resource.
     */
    const VIEWING_HINT = self::NS.'viewingHint';

    /**
     * Valid on manifest, sequence and range. The canvases represent pages in a bound volume, and should be presented
     * in a page-turning interface if one is available. The first canvas is a single view (the first recto) and thus
     * the second canvas represents the back of the object in the first canvas.
     */
    const VIEWING_HINT_PAGED = self::NS.'pagedHint';

    /**
     * Canvases with this hint must not be presented in a page turning interface, and must be skipped over when
     * determining the page sequence. This viewing hint must be ignored if the current sequence or manifest does not
     * have the ‘paged’ viewing hint.
     */
    const VIEWING_HINT_NONPAGED = self::NS.'nonPagedHint';

    /**
     * Only valid on a range. A range which has this viewingHint is the top-most node in a hierarchy of ranges that
     * represents a structure to be rendered by the client to assist in navigation. For example, a table of contents
     * within a paged object, major sections of a 3d object, the textual areas within a single scroll, and so forth.
     * Other ranges that are descendants of the “top” range are the entries to be rendered in the navigation structure.
     * There may be multiple ranges marked with this hint. If so, the client should display a choice of multiple
     * structures to navigate through.
     */
    const VIEWING_HINT_TOP = self::NS.'topHint';

    /**
     * Valid on manifest, sequence and range. Each canvas is the complete view of one side of a long scroll or roll and
     * an appropriate rendering might only display part of the canvas at any given time rather than the entire object.
     */
    const VIEWING_HINT_CONTINUOUS = self::NS.'continuousHint';

    /**
     * Valid on manifest, sequence and range. The canvases referenced from the resource are all individual sheets, and
     * should not be presented in a page-turning interface. Examples include a set of views of a 3 dimensional object,
     * or a set of the front sides of photographs in a collection.
     */
    const VIEWING_HINT_INDIVIDUALS = self::NS.'individualsHint';

    /**
     * Text that must be shown when the resource it is associated with is displayed or used. For example, this could be
     * used to present copyright or ownership statements, or simply an acknowledgement of the owning and/or publishing
     * institution. Clients should try to match the language preferred by the user, and if the preferred language is
     * unknown or unavailable, then the client may choose which value to display. If there are multiple values of the
     * same or unspecified language, then all of those values must be displayed.
     */
    const ATTRIBUTION = self::NS.'attributionLabel';

    /**
     * A list of short descriptive entries, given as pairs of human readable label and value to be displayed to the
     * user. The value should be either simple HTML, including links and text markup, or plain text, and the label
     * should be plain text. There are no semantics conveyed by this information, and clients should not use it for
     * discovery or other purposes. This list of descriptive pairs should be able to be displayed in a tabular form in
     * the user interface. Clients should have a way to display the information about manifests and canvases, and may
     * have a way to view the information about other resources. The client should display the pairs in the order
     * provided by the description. A pair might be used to convey the author of the work, information about its
     * creation, a brief physical description, or ownership information, amongst other use cases. The client is not
     * expected to take any action on this information beyond displaying the label and value. An example pair of label
     * and value might be a label of “Author” and a value of “Jehan Froissart”.
     */
    const METADATA_LABELS = self::NS.'metadataLabels';
}
