<?php

namespace LinkedData4Php\Annotations;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 */
class Iri
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var bool
     */
    public $collection = false;

    /**
     * @var string
     */
    public $type = null;
}
