<?php

namespace Anno4Php\Model\Traits;

use Anno4Php\Model\Ontology\DC;

trait ExternalWebResource
{
    use Resource;

    public function getLanguages()
    {
        return $this->getCollectionProperty(DC::LANGUAGE);
    }
}
