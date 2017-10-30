<?php

namespace LinkedData4Php\Annotations;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 */
class Iri
{
    /**
     * The IRI for the resource class represented by this annotation.
     *
     * @var string
     */
    public $value;

    /**
     * A flag indicating if this type is a collection.
     *
     * @var bool
     */
    public $collection = false;

    /**
     * The PHP-class that this type should be deserialized into.
     *
     * @var string
     */
    public $type = null;

    /**
     * An abstract class extended by generated {@link ResourceCode} classes to provide support methods.
     *
     * @var string
     */
    public $support = null;
}
