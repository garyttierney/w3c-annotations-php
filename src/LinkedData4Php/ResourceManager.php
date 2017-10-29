<?php

namespace LinkedData4Php;

use LinkedData4Php\Loader\ResourceLoader;
use LinkedData4Php\Metadata\ResourceMetadataRegistry;
use LinkedData4Php\Model\Resource;
use LinkedData4Php\Model\SimplePropertyMap;
use LinkedData4Php\Model\SimpleResource;
use ML\JsonLD\JsonLD;
use Symfony\Component\Serializer\SerializerInterface;

class ResourceManager
{
    /**
     * @var ResourceLoader
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
     * @param $data
     * @param null $type
     *
     * @return Resource
     */
    public function parse($data, $type = null): Resource
    {
        if (!is_array($data) && !is_string($data)) {
            throw new InvalidArgumentException('Expected array or string');
        }

        $data = JsonLD::compact($data);

        return $this->serializer->deserialize($data, $type ?: $data->{'@type'}, 'object');
    }

    public function load($iri): Resource
    {
    }

    public function create(string $type): Resource
    {
        $properties = new SimplePropertyMap();

        if ($this->metadataRegistry->supports($type)) {
            $metadata = $this->metadataRegistry->getMetadata($type);
            $className = $metadata->getImplementationClassName();

            return new $className(null, $metadata->getIri(), $properties);
        } else {
            return new SimpleResource(null, $type, $properties);
        }
    }
}
