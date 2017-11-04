<?php

namespace LinkedData4Php;

use LinkedData4Php\Loader\DocumentLoader;
use LinkedData4Php\Metadata\ResourceMetadataRegistry;
use LinkedData4Php\Model\ResourceInterface;
use LinkedData4Php\Model\SimpleResource;
use ML\JsonLD\JsonLD;
use Symfony\Component\Serializer\SerializerInterface;

class ResourceManager
{
    /**
     * @var DocumentLoader
     */
    private $loader;
    /**
     * @var ResourceMetadataRegistry
     */
    private $metadataRegistry;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        ResourceMetadataRegistry $metadataRegistry,
        SerializerInterface $serializer
    ) {
        $this->metadataRegistry = $metadataRegistry;
        $this->serializer = $serializer;
    }

    /**
     * @param array|object|string $data
     * @param string|null         $type
     *
     * @return ResourceInterface
     *
     * @throws \InvalidArgumentException
     */
    public function parse($data, string $type = null): ResourceInterface
    {
        if (!is_array($data) && !is_string($data) && !is_object($data)) {
            throw new \InvalidArgumentException('Expected array, object, or string');
        }

        $data = JsonLD::compact($data);

        return $this->serializer->deserialize(
            $data,
            SimpleResource::class,
            'object',
            [
                'resource_class' => $data->{'@type'},
            ]
        );
    }
}
