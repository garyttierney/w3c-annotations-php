<?php

namespace LinkedData4Php\Serializer;

use LinkedData4Php\Metadata\ResourceMetadataRegistry;
use LinkedData4Php\Model\Properties\SimplePropertyMap;
use LinkedData4Php\Model\SimpleResource;
use ML\IRI\IRI;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResourceDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    /**
     * @var ResourceMetadataRegistry
     */
    private $metadataRegistry;

    /**
     * @var DenormalizerInterface
     */
    private $denormalizer;

    public function __construct(ResourceMetadataRegistry $metadataRegistry)
    {
        $this->metadataRegistry = $metadataRegistry;
    }

    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed  $data    data to restore
     * @param string $class   the expected class to instantiate
     * @param string $format  format the given data was extracted from
     * @param array  $context options available to the denormalizer
     *
     * @return object
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['@value']) || is_string($data)) {
            return $data['@value'] ?? $data;
        }

        $metadata = null;
        $resourceTypeIri = null;
        $resourceId = null;
        $resourceClass = SimpleResource::class;

        if (isset($data['@id'])) {
            $resourceId = new IRI($data['@id']);
        }

        if (isset($data['@type'])) {
            $resourceTypeIri = $data['@type'];
        }

        if (SimpleResource::class === $class && isset($data['@type'])
            && $this->metadataRegistry->supports($data['@type'])) {
            $metadata = $this->metadataRegistry->getMetadata($data['@type']);
        } elseif ($this->metadataRegistry->supports($class)) {
            $metadata = $this->metadataRegistry->getMetadata($class);
        }

        if (null !== $metadata) {
            $resourceClass = $this->metadataRegistry->getImplementationClass($metadata->getClassName());

            if (null === $resourceTypeIri) {
                $resourceTypeIri = $metadata->getIri();
            }
        }

        foreach ($data as $property => &$value) {
            if ('@' === $property[0]) {
                unset($data[$property]);
                continue;
            }

            if (null !== $metadata && $metadata->hasPropertyMetadata($property)) {
                $propertyMetadata = $metadata->getPropertyMetadata($property);
                $valueType = $propertyMetadata->getValueType();

                if (!$this->metadataRegistry->supports($valueType)) {
                    $valueType = SimpleResource::class;
                }

                if ($propertyMetadata->isCollection()) {
                    $items = $value['@list'] ?? $value['@set'] ?? $value;

                    if ((is_array($value) && self::isAssociativeArray($value)) || !is_array($items)) {
                        $items = [$items];
                    }

                    $value = array_map(
                        function ($item) use ($valueType) {
                            if (!interface_exists($valueType) && SimpleResource::class !== $valueType) {
                                return $item;
                            } else {
                                return $this->denormalizer->denormalize($item, $valueType);
                            }
                        },
                        $items
                    );
                } elseif ($propertyMetadata->isScalar()) {
                    $scalar = $value['@value'] ?? $value['@id'] ?? $value;
                    if (is_array($scalar)) {
                        throw new \RuntimeException("Expected scalar for $property");
                    }

                    $value = $scalar;
                } else {
                    $value = $this->denormalizer->denormalize($value, $valueType);
                }
            } else {
                $value = $this->denormalizer->denormalize($value, SimpleResource::class);
            }
        }

        return new $resourceClass($resourceId, $resourceTypeIri, new SimplePropertyMap($data));
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->metadataRegistry->supports($type) || SimpleResource::class === $type;
    }

    public function setDenormalizer(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    private static function isAssociativeArray(array $value)
    {
        return array_keys($value) !== range(0, count($value) - 1);
    }
}
