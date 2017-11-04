<?php

namespace LinkedData4Php\Serializer;

use LinkedData4Php\Metadata\ResourceMetadataRegistry;
use LinkedData4Php\Metadata\ResourcePropertyMetadata;
use LinkedData4Php\Model\Properties\SimplePropertyMap;
use LinkedData4Php\Model\SimpleResource;
use ML\IRI\IRI;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Deserializer for JSON-LD values.  Handles data in the following formats:
 * <ul>
 * <li>Object with an id and type</li>
 * <li>Object with no type but inferred from class</li>
 * <li>id as a string literal</li>
 * <li>literal type inferred from PHP class</li>
 * <li>literal with value</li>
 * <li>collection of literals with value and language as localized values</li>
 * <li>Collection of objects with id and type</li>
 * <li>Collection of objects with no type but type inferred from class</li>
 * <li>Collection of id's</li>
 * </ul>.
 */
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
     * Denormalizes a blob of JSON-LD into a graph of {@link ResourceInterface}s.
     *
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $resourceId = isset($data['@id']) ? new IRI($data['@id']) : null;
        $resourceClass = $context['resource_class'] ?? $class;

        $resourceMetadata = $this->metadataRegistry->getMetadata($resourceClass);
        $resourceClassImpl = $this->metadataRegistry->getImplementationClass($resourceClass);
        $resourceClassIri = $resourceMetadata->getIri();

        //@todo - allow deserializing other types, like DateTime objects
        foreach ($data as $property => &$value) {
            if ('@' === $property[0]) {
                unset($data[$property]);
                continue;
            }

            if (!$resourceMetadata->hasPropertyMetadata($property)) {
                continue;
            }

            $propertyMetadata = $resourceMetadata->getPropertyMetadata($property);

            if ($propertyMetadata->isCollection()) {
                $value = self::isIndexedArray($value) ? $value : [$value];

                foreach ($value as &$item) {
                    $item = $this->denormalizePropertyValue($propertyMetadata, $item);
                }

                unset($item);
            } else {
                $value = $this->denormalizePropertyValue($propertyMetadata, $value);
            }
        }

        return new $resourceClassImpl($resourceId, $resourceClassIri, new SimplePropertyMap($data));
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->metadataRegistry->supports($type) || SimpleResource::class === $type;
    }

    public function setDenormalizer(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    /**
     * Check if the given {@code value} is an array with keys [0,N), where {@code N} is the size of the array.
     *
     * @param $value
     *
     * @return bool {@code true} iff {@code value} is an array with no associative keys
     */
    private static function isIndexedArray($value)
    {
        return is_array($value) && array_keys($value) === range(0, count($value) - 1);
    }

    /**
     * Denormalize the {@code data} of a property using the associated {@link ResourcePropertyMetadata}.
     */
    private function denormalizePropertyValue(ResourcePropertyMetadata $metadata, $data)
    {
        if ($metadata->isScalar()) {
            return $this->denormalizeScalar($metadata, $data);
        }

        $type = $this->findType($metadata->getValueType(), $data);
        $supported = $this->metadataRegistry->supports($type);

        if ($supported) {
            return $this->denormalizer->denormalize($data, $type);
        }

        return $data;
    }

    /**
     * Denormalize a {@code scalar} value given an array containing a value, or a single literal.
     *
     * @param ResourcePropertyMetadata $metadata
     * @param $data
     *
     * @return mixed|null
     */
    private function denormalizeScalar(ResourcePropertyMetadata $metadata, $data)
    {
        if (is_array($data)) {
            $value = $data['@value'] ?? $data['@id'] ?? null;

            if (null === $value) {
                return $data; // can't denormalize, return original data
            }
        } else {
            $value = $data;
        }

        return $value;
    }

    /**
     * Determine the best type to decode {@code data} into the objects embedded type data and a PHP class.
     *
     * @param string $expectedType the PHP class the type is expected to be decoded into
     * @param mixed  $data         the data to be decoded
     *
     * @return string
     */
    private function findType(string $expectedType, $data)
    {
        if (is_array($data) && isset($data['@type']) && $this->metadataRegistry->supports($data['@type'])) {
            return $data['@type'];
        }

        return $this->metadataRegistry->supports($expectedType) ? $expectedType : SimpleResource::class;
    }
}
