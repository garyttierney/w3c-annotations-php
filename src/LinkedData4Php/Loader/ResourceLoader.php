<?php

namespace LinkedData4Php\Loader;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;
use ML\JsonLD\JsonLD;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class ResourceLoader
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var UriFactory
     */
    private $uriFactory;
    /**
     * @var MessageFactory
     */
    private $message;

    public function __construct(
        HttpClient $httpClient,
        UriFactory $uriFactory,
        MessageFactory $message,
        SerializerInterface $serializer
    ) {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->uriFactory = $uriFactory;
        $this->message = $message;
    }

    public function load($iri, $resourceType = null)
    {
        $uri = $this->uriFactory->createUri((string) $iri);
        $request = $this->message->createRequest('GET', $uri);

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (Throwable $e) {
            throw new ResourceLoaderException("Unable to dereference resource IRI at $iri", $e);
        }

        $resourceJson = (string) $response->getBody();
        $resourceProperties = JsonLD::compact($resourceJson);

        if (null === $resourceType) {
            $resourceType = $resourceProperties['@type'];
        }

        return $this->serializer->deserialize($resourceProperties, $resourceType, 'object');
    }
}
