<?php

namespace LinkedData4Php\Model;

use LinkedData4Php\Model\Properties\PropertyMap;
use ML\IRI\IRI;

interface Resource
{
    public function getId(): ?IRI;

    public function getType(): ?string;

    public function getProperties(): PropertyMap;
}
