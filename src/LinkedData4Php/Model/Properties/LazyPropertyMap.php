<?php

namespace LinkedData4Php\Model\Properties;

use LinkedData4Php\Serializer\ResourceLoader;

class LazyPropertyMap
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var ResourceLoader
     */
    private $loader;

    public function __construct(string $id, string $type, ResourceLoader $loader)
    {
        $this->id = $id;
        $this->type = $type;
        $this->loader = $loader;
    }
}
