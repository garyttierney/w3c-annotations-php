<?php

namespace LinkedData4Php\CodeGen;

final class ResourceCode
{
    /**
     * @var string
     */
    private $fqName;
    /**
     * @var string
     */
    private $code;

    public function __construct(string $fqName, string $code)
    {
        $this->fqName = $fqName;
        $this->code = $code;
    }

    public function load()
    {
        if (!class_exists($this->fqName)) {
            eval($this->code);
        }
    }

    public function getFqName()
    {
        return $this->fqName;
    }
}
