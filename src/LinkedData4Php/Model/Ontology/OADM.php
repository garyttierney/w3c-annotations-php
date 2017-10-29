<?php

namespace LinkedData4Php\Model\Ontology;

/**
 * Ontology class for the <a href="http://www.w3.org/ns/oa#">Open Annotation Data Model (oa:)</a>.
 */
final class OADM
{
    /**
     * Textual representation of the namespace.
     */
    const NS = 'http://www.w3.org/ns/oa#';

    /**
     * Textual prefix of the ontology.
     */
    const PREFIX = 'oa';

    /**
     * Refers to http://www.w3.org/ns/oa#Annotation
     * Typically an Annotation has a single Body (oa:hasBody), which is the comment or other descriptive resource, and a single Target (oa:hasTarget) that the Body is somehow "about". The Body provides the information which is annotating the Target.
     * This "aboutness" may be further clarified or extended to notions such as classifying or identifying with oa:motivatedBy.
     */
    const ANNOTATION = self::NS.'Annotation';

    /**
     * Refers to http://www.w3.org/ns/oa#Tag
     * A class assigned to the Body when it is a tag, such as a embedded text string with cnt:chars.
     * Tags are typically keywords or labels, and used for organization, description or discovery of the resource being tagged. In the Semantic Web, URIs are used instead of strings to avoid the issue of polysemy where one word has multiple meanings, such usage MUST be indicated using the subclass oa:SemanticTag.
     * Annotations that tag resources, either with text or semantic tags, SHOULD also have the oa:tagging motivation to make the reason for the Annotation more clear to applications, and MAY have other motivations as well.
     */
    const TAG = self::NS.'Tag';

    /**
     * Refers to http://www.w3.org/ns/oa#SemanticTag
     * A class assigned to the Body when it is a semantic tagging resource; a URI that identifies a concept, rather than an embedded string, frequently a term from a controlled vocabulary.
     * It is NOT RECOMMENDED to use the URI of a document as a Semantic Tag, as it might also be used as a regular Body in other Annotations which would inherit the oa:SemanticTag class assignment. Instead it is more appropriate to create a new URI and link it to the document, using the foaf:page predicate.
     */
    const SEMANTIC_TAG = self::NS.'SemanticTag';

    /**
     * Refers to http://www.w3.org/ns/oa#SpecificResource
     * A resource identifies part of another Source resource, a particular representation of a resource, a resource with styling hints for renders, or any combination of these.
     * The Specific Resource takes the role of oa:hasBody or oa:hasTarget in an oa:Annotation instead of the Source resource.
     * There MUST be exactly 1 oa:hasSource relationship associated with a Specific Resource.
     * There MUST be exactly 0 or 1 oa:hasSelector relationship associated with a Specific Resource.
     * There MAY be 0 or 1 oa:hasState relationship for each Specific Resource.
     * If the Specific Resource has an HTTP URI, then the exact segment of the Source resource that it identifies, and only the segment, MUST be returned when the URI is dereferenced. For example, if the segment of interest is a region of an image and the Specific Resource has an HTTP URI, then dereferencing it MUST return the selected region of the image as it was at the time when the annotation was created. Typically this would be a burden to support, and thus the Specific Resource SHOULD be identified by a globally unique URI, such as a UUID URN. If it is not considered important to allow other Annotations or systems to refer to the Specific Resource, then a blank node MAY be used instead.
     */
    const SPECIFIC_RESOURCE = self::NS.'SpecificResource';

    /**
     * Refers to http://www.w3.org/ns/oa#Choice
     * A multiplicity construct that conveys to a consuming application that it should select one of the constituent resources to display to the user, and not render/use all of them.
     * oa:Choice can be used as the object of the object of the oa:hasBody, oa:hasTarget, oa:hasSelector, oa:hasState, oa:styledBy and oa:hasScope relationships,
     * There MUST be 1 or more oa:item relationships for each oa:Choice.
     * There SHOULD be exactly 1 default relationship for each Choice.
     */
    const CHOICE = self::NS.'Choice';

    /**
     * http://www.w3.org/ns/oa#Composite
     * A multiplicity construct that conveys to a consuming application that all of the constituent resources are required for the Annotation to be correctly interpreted.
     * oa:Composite can be used as the object of the object of the oa:hasBody, oa:hasTarget, oa:hasSelector, oa:hasState, oa:styledBy and oa:hasScope relationships,
     * There MUST be 2 or more oa:item relationships for each oa:Composite.
     */
    const COMPOSITE = self::NS.'Composite';

    /**
     * Refers to http://www.w3.org/ns/oa#List
     * A multiplicity construct that conveys to a consuming application that all of the constituent resources are required for the Annotation to be correctly interpreted, and in a particular order.
     * oa:List can be used as the object of the object of the oa:hasBody, oa:hasTarget, oa:hasSelector, oa:hasState, oa:styledBy and oa:hasScope relationships,
     * There MUST be 2 or more oa:item relationships for each oa:List, with their order defined using the rdf:List construct of rdf:first/rdf:rest/rdf:nil.
     * All the elements of the list should also be declared using oa:item, and each of the oa:items should appear at least once in the list.
     */
    const LIST = self::NS.'List';

    /**
     * Refers to http://www.w3.org/ns/oa#Content
     * The class for resources embedded in the Annotation graph, other than for textual content that is the object of the hasBody relationship.
     */
    const CONTENT = self::NS.'Content';

    /**
     * Refers to http://www.w3.org/ns/oa#TextualBody.
     */
    const TEXTUAL_BODY = self::NS.'TextualBody';

    /**
     * Refers to http://www.w3.org/ns/oa#ResourceSelection
     * Instances of the ResourceSelection class identify part (described by an oa:Selector) of another resource
     * (referenced with oa:hasSource), possibly from a particular representation of a resource (described by an oa:State).
     * Please note that ResourceSelection is not used directly in the Web Annotation model, but is provided as a separate
     * class for further application profiles to use, separate from oa:SpecificResource which has many Annotation specific features.
     */
    const RESOURCE_SELECTION = self::NS.'ResourceSelection';

    /**
     * Refers to http://www.w3.org/ns/oa#State.
     * A State describes the intended state of a resource as applied to the particular Annotation, and thus provides
     * the information needed to retrieve the correct representation of that resource.
     */
    const STATE = self::NS.'State';

    /**
     * Refers to http://www.w3.org/ns/oa#TimeState
     * A TimeState records the time at which the resource's state is appropriate for the Annotation, typically the time
     * that the Annotation was created and/or a link to a persistent copy of the current version.
     */
    const TIME_STATE = self::NS.'TimeState';

    /**
     * Refers to http://www.w3.org/ns/oa#HttpState
     * The HttpRequestState class is used to record the HTTP request headers that a client should use to request the
     * correct representation from the resource.
     */
    const HTTP_REQUEST_STATE = self::NS.'HttpRequestState';

    /**
     * Refers to http://www.w3.org/ns/oa#CssStyle
     * A resource which describes styles for resources participating in the Annotation using CSS.
     */
    const CSS_STYLE = self::NS.'CssStyle';

    /**
     * Refers to http://www.w3.org/ns/oa#Motivation
     * The Motivation for creating an Annotation, indicated with oa:motivatedBy, is a reason for its creation, and might include things like oa:replying to another annotation, oa:commenting on a resource, or oa:linking to a related resource.
     * Each Annotation SHOULD have at least one oa:motivatedBy relationship to an instance of oa:Motivation, which is a subClass of skos:Concept.
     */
    const MOTIVATION = self::NS.'Motivation';

    /**
     * Refers to http://www.w3.org/ns/oa#assessing.
     * The motivation for when the user intends to provide an assessment about the Target resource.
     */
    const MOTIVATION_ASSESSING = self::NS.'assessing';

    /**
     * Refers to http://www.w3.org/ns/oa#bookmarking
     * The motivation that represents the creation of a bookmark to the target resources or recorded point or points within one or more resources. For example, an Annotation that bookmarks the point in a text where the reader finished reading. Bookmark Annotations may or may not have a Body resource.
     */
    const MOTIVATION_BOOKMARKING = self::NS.'bookmarking';

    /**
     * Refers to http://www.w3.org/ns/oa#classifying
     * The motivation that represents the assignment of a classification type, typically from a controlled vocabulary, to the target resource(s). For example to classify an Image resource as a Portrait.
     */
    const MOTIVATION_CLASSIFYING = self::NS.'classifying';

    /**
     * Refers to http://www.w3.org/ns/oa#commenting
     * The motivation that represents a commentary about or review of the target resource(s). For example to provide a commentary about a particular PDF.
     */
    const MOTIVATION_COMMENTING = self::NS.'commenting';

    /**
     * Refers to http://www.w3.org/ns/oa#describing
     * The motivation that represents a description of the target resource(s), as opposed to a comment about them. For example describing the above PDF's contents, rather than commenting on their accuracy.
     */
    const MOTIVATION_DESCRIBING = self::NS.'describing';

    /**
     * Refers to http://www.w3.org/ns/oa#editing
     * The motivation that represents a request for a modification or edit to the target resource. For example, an Annotation that requests a typo to be corrected.
     */
    const MOTIVATION_EDITING = self::NS.'editing';

    /**
     * Refers to http://www.w3.org/ns/oa#highlighting
     * The motivation that represents a highlighted section of the target resource or segment. For example to draw attention to the selected text that the annotator disagrees with. A Highlight may or may not have a Body resource.
     */
    const MOTIVATION_HIGHLIGHTING = self::NS.'highlighting';

    /**
     * Refers to http://www.w3.org/ns/oa#identifying
     * The motivation that represents the assignment of an identity to the target resource(s). For example, annotating the name of a city in a string of text with the URI that identifies it.
     */
    const MOTIVATION_IDENTIFYING = self::NS.'identifying';

    /**
     * Refers to http://www.w3.org/ns/oa#linking
     * The motivation that represents an untyped link to a resource related to the target.
     */
    const MOTIVATION_LINKING = self::NS.'linking';

    /**
     * Refers to http://www.w3.org/ns/oa#moderating
     * The motivation that represents an assignment of value or quality to the target resource(s). For example annotating an Annotation to moderate it up in a trust network or threaded discussion.
     */
    const MOTIVATION_MODERATING = self::NS.'moderating';

    /**
     * Refers to http://www.w3.org/ns/oa#questioning
     * The motivation that represents asking a question about the target resource(s). For example to ask for assistance with a particular section of text, or question its veracity.
     */
    const MOTIVATION_QUESTIONING = self::NS.'questioning';

    /**
     * Refers to http://www.w3.org/ns/oa#replying
     * The motivation that represents a reply to a previous statement, either an Annotation or another resource. For example providing the assistance requested in the above.
     */
    const MOTIVATION_REPLYING = self::NS.'replying';

    /**
     * Refers to http://www.w3.org/ns/oa#tagging
     * The motivation that represents adding a Tag on the target resource(s). One or more of the bodies of the annotation should be typed as a oa:Tag or oa:SemanticTag.
     */
    const MOTIVATION_TAGGING = self::NS.'tagging';

    // ---------- Selector ----------

    /**
     * Refers to http://www.w3.org/ns/oa#Selector
     * A resource which describes the segment of interest in a representation of a Source resource, indicated with oa:hasSelector from the Specific Resource.
     * This class is not used directly in Annotations, only its subclasses are.
     * The nature of the Selector will be dependent on the type of the representation for which the segment is conveyed. The specific type of selector should be indicated using a subclass of oa:Selector.
     * The Specifier's description MAY be conveyed as an external or embedded resource (cnt:Content), or as RDF properties within the graph. The description SHOULD use existing standards whenever possible. If the Specifier has an HTTP URI, then its description, and only its description, MUST be returned when the URI is dereferenced.
     */
    const SELECTOR = self::NS.'Selector';

    /**
     * Refers to http://www.w3.org/ns/oa#FragmentSelector
     * A Selector which describes the segment of interest in a representation, through the use of the fragment identifier component of a URI.
     * It is RECOMMENDED to use oa:FragmentSelector as the selector on a Specific Resource rather than annotating the fragment URI directly, in order to improve discoverability of annotation on the Source.
     * The oa:FragmentSelector MUST have exactly 1 rdf:value property, containing the fragment identifier component of a URI that describes the segment of interest in the resource, excluding the initial "#".
     * The Fragment Selector SHOULD have a dcterms:conformsTo relationship with the object being the specification that defines the syntax of the fragment, for instance <http://tools.ietf.org/rfc/rfc3236> for HTML fragments.
     */
    const FRAGMENT_SELECTOR = self::NS.'FragmentSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#SvgSelector
     * A Selector which selects an area specified as an SVG shape.
     * The SVG document should either be retrievable by resolving the URI of this resource, or be included as an Embedded Resource using cnt:Content.
     * It is RECOMMENDED that the document contain only a single shape element and that element SHOULD be one of: path, rect, circle, ellipse, polyline, polygon or g. The g element SHOULD ONLY be used to construct a multi-element group, for example to define a donut shape requiring an outer circle and a clipped inner circle.
     * The dimensions of both the shape and the SVG canvas MUST be relative to the dimensions of the Source resource. For example, given an image which is 600 pixels by 400 pixels, and the desired section is a circle of 100 pixel radius at the center of the image, then the SVG element would be: <circle cx="300" cy="200" r="100"/>
     * It is NOT RECOMMENDED to include style information within the SVG element, nor Javascript, animation, text or other non shape oriented information. Clients SHOULD ignore such information if present.
     */
    const SVG_SELECTOR = self::NS.'SvgSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#DataPositionSelector
     * A Selector which describes a range of data based on its start and end positions within the byte stream of the representation.
     * Each DataPositionSelector MUST have exactly 1 oa:start property.
     * Each TextPositionSelector MUST have exactly 1 oa:end property.
     * See oa:TextPositionSelector for selection at normalized character level rather than bytestream level.
     */
    const DATA_POSITION_SELECTOR = self::NS.'DataPositionSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#TextPositionSelector
     * An oa:Selector which describes a range of text based on its start and end positions.
     * The text MUST be normalized before counting characters. For a Selector that works from the bitstream rather than the rendered characters, see oa:DataPositionSelector.
     * Each oa:TextPositionSelector MUST have exactly 1 oa:start property.
     * Each oa:TextPositionSelector MUST have exactly 1 oa:end property.
     */
    const TEXT_POSITION_SELECTOR = self::NS.'TextPositionSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#TextQuoteSelector
     * A Selector that describes a textual segment by means of quoting it, plus passages before or after it.
     * For example, if the document were "abcdefghijklmnopqrstuvwxyz", one could select "efg" by a oa:prefix of "abcd", the quotation of oa:exact "efg" and a oa:suffix of "hijk".
     * The text MUST be normalized before recording.
     * Each TextQuoteSelector MUST have exactly 1 oa:exact property.
     * Each TextQuoteSelector SHOULD have exactly 1 oa:prefix property, and MUST NOT have more than 1.
     * Each TextQuoteSelector SHOULD have exactly 1 oa:suffix property, and MUST NOT have more than 1.
     */
    const TEXT_QUOTE_SELECTOR = self::NS.'TextQuoteSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#CssSelector
     * A CssSelector describes a Segment of interest in a representation that conforms to the Document Object Model
     * through the use of the CSS selector specification.
     */
    const CSS_SELECTOR = self::NS.'CssSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#XPathSelector
     * An XPathSelector is used to select elements and content within a resource that supports the Document Object
     * Model via a specified XPath value.
     */
    const XPATH_SELECTOR = self::NS.'XPathSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#RangeSelector
     * A Range Selector can be used to identify the beginning and the end of the selection by using other Selectors.
     * The selection consists of everything from the beginning of the starting selector through to the beginning of the
     * ending selector, but not including it.
     */
    const RANGE_SELECTOR = self::NS.'RangeSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#styleClass
     * The name of the class used in the CSS description referenced from the Annotation that should be applied to the
     * Specific Resource.
     */
    const STYLE = self::NS.'Style';

    /**
     * Refers to http://www.w3.org/ns/oa#hasBody
     * The relationship between oa:Annotation and body. The body is somehow "about" the oa:hasTarget of the annotation.
     * The Body may be of any media type, and contain any type of content. The Body SHOULD be identified by HTTP URIs unless they are embedded within the Annotation.
     * Embedded bodies SHOULD be instances of cnt:ContentAsText and embed their content with cnt:chars. They SHOULD declare their media type with dc:format, and MAY indicate their language using dc:language and a RFC-3066 language tag.
     * There is no OA class provided for "Body" as a body might be a target of a different annotation. However, there SHOULD be 1 or more content-based classes associated with the body resources of an Annotation, and the dctypes: vocabulary is recommended for this purpose, for instance dctypes:Text to declare textual content.
     */
    const HAS_BODY = self::NS.'hasBody';

    /**
     * Refers to http://www.w3.org/ns/oa#hasTarget
     * The relationship between oa:Annotation and target. The target resource is what the oa:hasBody is somewhat "about".
     * The target may be of any media type, and contain any type of content. The target SHOULD be identified by HTTP URIs unless they are embedded within the Annotation.
     * Embedded targets SHOULD be instances of cnt:ContentAsText and embed their content with cnt:chars. They SHOULD declare their media type with dc:format, and MAY indicate their language using dc:language and a RFC-3066 language tag.
     * There is no OA class provided for "Target" as a target might be a body in a different annotation. However, there SHOULD be 1 or more content-based classes associated with the target resources of an Annotation, and the dctypes: vocabulary is recommended for this purpose, for instance dctypes:Text to declare textual content.
     */
    const HAS_TARGET = self::NS.'hasTarget';

    /**
     * Refers to http://www.w3.org/ns/oa#annotatedBy
     * The object of the relationship is a resource that identifies the agent responsible for creating the Annotation. This may be either a human or software agent.
     * There SHOULD be exactly 1 oa:annotatedBy relationship per Annotation, but MAY be 0 or more than 1, as the Annotation may be anonymous, or multiple agents may have worked together on it.
     * It is RECOMMENDED to use these and other FOAF terms to describe agents: foaf:Person, prov:SoftwareAgent, foaf:Organization, foaf:name, foaf:mbox, foaf:openid, foaf:homepage.
     */
    const ANNOTATED_BY = self::NS.'annotatedBy';

    /**
     * Refers to http://www.w3.org/ns/oa#serializedBy
     * The object of the relationship is the agent, likely software, responsible for generatng the serialization of the Annotation's serialization.
     * It is RECOMMENDED to use these and other FOAF terms to describe agents: foaf:Person, prov:SoftwareAgent, foaf:Organization, foaf:name, foaf:mbox, foaf:openid, foaf:homepage
     * There MAY be 0 or more oa:serializedBy relationships per Annotation.
     */
    const SERIALIZED_BY = self::NS.'serializedBy';

    /**
     * Refers to http://www.w3.org/ns/oa#hasSelector
     * The relationship between a oa:SpecificResource and a oa:Selector.
     * There MUST be exactly 0 or 1 oa:hasSelector relationship associated with a Specific Resource.
     * If multiple Selectors are required, either to express a choice between different optional, equivalent selectors, or a chain of selectors that should all be processed, it is necessary to use oa:Choice, oa:Composite or oa:List as a selector.
     */
    const HAS_SELECTOR = self::NS.'hasSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#hasSource
     * The relationship between a oa:SpecificResource and the resource that it is a more specific representation of.
     * There MUST be exactly 1 oa:hasSource relationship associated with a Specific Resource.
     */
    const HAS_SOURCE = self::NS.'hasSource';

    /**
     * Refers to http://www.w3.org/ns/oa#hasScope
     * The relationship between a Specific Resource and the resource that provides the scope or context for it in this Annotation.
     * There MAY be 0 or more hasScope relationships for each Specific Resource.
     */
    const HAS_SCOPE = self::NS.'hasScope';

    /**
     * Refers to http://www.w3.org/ns/oa#motivatedBy
     * The relationship between an Annotation and a Motivation, indicating the reasons why the Annotation was created.
     * Each Annotation SHOULD have at least one oa:motivatedBy relationship, and MAY be more than 1.
     */
    const MOTIVATED_BY = self::NS.'motivatedBy';

    /**
     * Refers to http://www.w3.org/ns/oa#item
     * The relationship between a multiplicity construct node and its constituent resources.
     * There MUST be 1 or more item relationships for each multiplicity construct oa:Choice, oa:Composite and oa:List.
     */
    const ITEM = self::NS.'item';

    /**
     * The members of an oa:Choice element.
     */
    const MEMBERS = self::NS.'members';

    /**
     * Refers to http://www.w3.org/ns/oa#hasState
     * The relationship between the ResourceSelection, or its subclass SpecificResource, and a State resource.
     * Please note that the domain (oa:ResourceSelection) is not used directly in the Web Annotation model.
     */
    const HAS_STATE = self::NS.'hasState';

    /**
     * Refers to http://www.w3.org/ns/oa#refinedBy
     * The relationship between a Selector or State and another Selector or State that should be applied to the results
     * of the first to refine the processing of the source resource.
     */
    const REFINED_BY = self::NS.'refinedBy';

    /**
     * Refers to http://www.w3.org/ns/oa#hasStartSelector
     * The relationship between a RangeSelector and the Selector that describes the start position of the range.
     */
    const HAS_START_SELECTOR = self::NS.'hasStartSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#hasEndSelector
     * The relationship between a RangeSelector and the Selector that describes the end position of the range.
     */
    const HAS_END_SELECTOR = self::NS.'hasEndSelector';

    /**
     * Refers to http://www.w3.org/ns/oa#renderedVia
     * A system that was used by the application that created the Annotation to render the resource.
     */
    const RENDERED_VIA = self::NS.'renderedVia';

    /**
     * Refers to http://www.w3.org/ns/oa#hasPurpose
     * The purpose served by the resource in the Annotation.
     */
    const HAS_PURPOSE = self::NS.'hasPurpose';

    /**
     * Refers to http://www.w3.org/ns/oa#via
     * A object of the relationship is a resource from which the source resource was retrieved by the providing system.
     */
    const VIA = self::NS.'via';

    /**
     * Refers to http://www.w3.org/ns/oa#canonical
     * A object of the relationship is the canonical URI that can always be used to deduplicate the Annotation,
     * regardless of the current URI used to access the representation.
     */
    const CANONICAL = self::NS.'canonical';

    /**
     * Refers to http://www.w3.org/ns/oa#styledBy
     * A reference to a Stylesheet that should be used to apply styles to the Annotation rendering.
     */
    const STYLED_BY = self::NS.'styledBy';

    /**
     * Refers to http://www.w3.org/ns/oa#styleClass.
     * The name of the class used in the CSS description referenced from the Annotation that should be applied to
     * the Specific Resource.
     */
    const STYLE_CLASS = self::NS.'styleClass';

    /**
     * Refers to http://www.w3.org/ns/oa#cachedSource
     * A object of the relationship is a copy of the Source resource's representation, appropriate for the Annotation.
     */
    const CACHED_SOURCE = self::NS.'cachedSource';

    /**
     * Refers to http://www.w3.org/ns/oa#serializedAt
     * The time at which the agent referenced by oa:serializedBy generated the first serialization of the Annotation, and any subsequent substantially different one. The annotation graph MUST have changed for this property to be updated, and as such represents the last modified datestamp for the Annotation. This might be used to determine if it should be re-imported into a triplestore when discovered.
     * There MAY be exactly 1 oa:serializedAt property per Annotation, and MUST NOT be more than 1. The datetime MUST be expressed in the xsd:dateTime format, and SHOULD have a timezone specified.
     */
    const SERIALIZED_AT = self::NS.'serializedAt';

    /**
     * Refers to http://www.w3.org/ns/oa#annotatedAt
     * The time at which the Annotation was created.
     * There SHOULD be exactly 1 oa:annotatedAt property per Annotation, and MUST NOT be more than 1. The datetime MUST be expressed in the xsd:dateTime format, and SHOULD have a timezone specified.
     */
    const ANNOTATED_AT = self::NS.'annotatedAt';

    /**
     * Refers to http://www.w3.org/ns/oa#end
     * The end position of the segment of text or bytes. The first character/byte in the full text/stream is position 0. The character/byte indicated at position oa:end is NOT included within the selected segment.
     * See oa:DataPositionSelector and oa:oa:TextPositionSelector.
     */
    const END = self::NS.'end';

    /**
     * Refers to http://www.w3.org/ns/oa#exact
     * A copy of the text which is being selected, after normalization.
     * See oa:TextQuoteSelector.
     */
    const EXACT = self::NS.'exact';

    /**
     * Refers to http://www.w3.org/ns/oa#start
     * The starting position of the segment of text or bytes. The first character/byte in the full text/stream is position 0. The character/byte indicated at position oa:start is included within the selected segment.
     * See oa:DataPositionSelector and oa:TextPositionSelector.
     */
    const START = self::NS.'start';

    /**
     * Refers to http://www.w3.org/ns/oa#prefix
     * A snippet of text that occurs immediately before the text which is being selected.
     * See oa:TextQuoteSelector.
     */
    const PREFIX_TEXT = self::NS.'prefix';

    /**
     * Refers to http://www.w3.org/ns/oa#suffix
     * The snippet of text that occurs immediately after the text which is being selected.
     * See oa:TextQuoteSelector.
     */
    const SUFFIX = self::NS.'suffix';

    /**
     * Refers to http://www.w3.org/ns/oa#when
     * The timestamp at which the Source resource should be interpreted for the Annotation, typically the time that the Annotation was created.
     */
    const WHEN = self::NS.'when';

    /**
     * Refers to http://www.w3.org/ns/oa#default
     * The constituent resource of a oa:Choice to use as a default option, if
     * there is no other means to determine which would be most appropriate.
     *
     * There SHOULD be exactly 1 default relationship for each Choice.
     */
    const DEFAULT = self::NS.'default';

    /**
     * Refers to http://www.w3.org/ns/oa#bodyText
     * The object of the predicate is a plain text string to be used as the content of the body of the Annotation.
     * The value must be an xsd:string and that data type must not be expressed in the serialization. Note that language
     * must not be associated with the value either as a language tag, as that is only available for rdf:langString.
     */
    const BODY_TEXT = self::NS.'bodyText';

    /**
     * Refers to http://www.w3.org/ns/oa#text
     * The content of a resource, given as text.
     */
    const TEXT = self::NS.'text';

    /**
     * Refers to http://www.w3.org/ns/oa#sourceDate
     * The timestamp at which the Source resource should be interpreted as being applicable to the Annotation.
     */
    const SOURCE_DATE = self::NS.'sourceDate';

    /**
     * Refers to http://www.w3.org/ns/oa#sourceDate
     * The start timestamp of the interval over which the Source resource should be interpreted as being applicable
     * to the Annotation.
     */
    const SOURCE_DATE_START = self::NS.'sourceDateStart';

    /**
     * Refers to http://www.w3.org/ns/oa#sourceDate
     * The end timestamp of the interval over which the Source resource should be interpreted as being applicable
     * to the Annotation.
     */
    const SOURCE_DATE_END = self::NS.'sourceDateEnd';

    /**
     * Refers to http://www.w3.org/ns/oa#processingLanguage.
     * The object of the property is the language that should be used for textual processing algorithms when dealing
     * with the content of the resource, including hyphenation, line breaking, which font to use for rendering and
     * so forth. The value must follow the recommendations of [BCP47].
     */
    const PROCESSING_LANGUAGE = self::NS.'processingLanguage';

    /**
     * Refers to http://www.w3.org/ns/oa#textDirection.
     * The direction of the text of the subject resource. There must only be one text direction associated with
     * any given resource.
     */
    const TEXT_DIRECTION = self::NS.'textDirection';

    /**
     * http://www.w3.org/ns/oa#rtlDirection.
     * The direction of text that is read from right to left.
     */
    const RIGHT_TO_LEFT_DIRECTION = self::NS.'rtlDirection';

    /**
     * Refers to http://www.w3.org/ns/oa#ltrDirection.
     * The direction of text that is read from left to right.
     */
    const LEFT_TO_RIGHT_DIRECTION = self::NS.'ltrDirection';

    /**
     * Refers to http://www.w3.org/ns/oa#autoDirection.
     * The direction of text that should be automatically determined from the content.
     */
    const AUTO_DIRECTION = self::NS.'autoDirection';

    private function __construct()
    {
    }

    /**
     * Return a string in the OA namespace.
     *
     * @param string $term the term to be put in the OA namespace
     */
    public static function NS(string $term)
    {
        return self::NS.$term;
    }
}
