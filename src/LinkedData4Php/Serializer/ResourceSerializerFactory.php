<?php

namespace LinkedData4Php\Serializer;

use LinkedData4Php\Metadata\ResourceMetadataRegistry;
use LinkedData4Php\Serializer\Decoder\StdClassDecoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ResourceSerializerFactory
{
    /**
     * @var ResourceMetadataRegistry
     */
    private $registry;

    public function __construct(ResourceMetadataRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function create(): SerializerInterface
    {
        return new Serializer(
            [
                new ResourceDenormalizer($this->registry),
            ],
            [
                new StdClassDecoder(),
            ]
        );
    }
}
