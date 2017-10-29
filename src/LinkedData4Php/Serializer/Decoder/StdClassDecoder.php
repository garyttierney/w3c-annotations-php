<?php

namespace LinkedData4Php\Serializer\Decoder;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use UnexpectedValueException;

class StdClassDecoder implements DecoderInterface
{
    /**
     * Decodes a string into PHP data.
     *
     * @param string $data    Data to decode
     * @param string $format  Format name
     * @param array  $context options that decoders have access to
     *
     * The format parameter specifies which format the data is in; valid values
     * depend on the specific implementation. Authors implementing this interface
     * are encouraged to document which formats they support in a non-inherited
     * phpdoc comment.
     *
     * @return mixed
     *
     * @throws UnexpectedValueException
     */
    public function decode($data, $format, array $context = [])
    {
        if (!($data instanceof \stdClass)) {
            throw new UnexpectedValueException('Expected stdClass, found '.get_class($data));
        }

        return json_decode(json_encode($data), true);
    }

    /**
     * Checks whether the deserializer can decode from given format.
     *
     * @param string $format format name
     *
     * @return bool
     */
    public function supportsDecoding($format)
    {
        return 'object' === $format;
    }
}
