<?php

namespace Anno4Php\Serializer;

use Anno4Php\Model\Annotation;
use Anno4Php\Model\Ontology\OADM;
use ML\JsonLD\DocumentFactoryInterface;
use ML\JsonLD\DocumentLoaderInterface;
use ML\JsonLD\FileGetContentsLoader;
use ML\JsonLD\JsonLD;

/**
 * @todo: override document factory so nodes can be customized instead of parsing after document loads.
 */
class AnnotationSerializer
{
    /**
     * @var DocumentFactoryInterface
     */
    private $documentLoader;

    public function __construct(DocumentLoaderInterface $documentLoader = null)
    {
        $this->documentLoader = $documentLoader ?: new FileGetContentsLoader();
    }

    public function deserialize(string $input): Annotation
    {
        $options = [
            'documentLoader' => $this->documentLoader,
        ];

        $graph = JsonLD::getDocument($input, $options)->getGraph();
        $annotationNodes = $graph->getNodesByType(OADM::ANNOTATION);

        if (count($annotationNodes) > 1) {
            throw new \InvalidArgumentException('Found more than one annotation in the input');
        }

        return new Annotation(array_pop($annotationNodes));
    }

    public function serialize(Annotation $input): string
    {
        return $input->toString(false);
    }
}
