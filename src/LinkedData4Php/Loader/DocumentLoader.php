<?php

namespace LinkedData4Php\Loader;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;
use ML\JsonLD\DocumentLoaderInterface;
use ML\JsonLD\Exception\JsonLdException;
use ML\JsonLD\JsonLD;
use ML\JsonLD\Processor;
use ML\JsonLD\RemoteDocument;
use Throwable;

class DocumentLoader implements DocumentLoaderInterface
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var UriFactory
     */
    private $uriFactory;
    /**
     * @var MessageFactory
     */
    private $messageFactory;

    public function __construct(
        HttpClient $httpClient = null,
        UriFactory $uriFactory = null,
        MessageFactory $message = null
    ) {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->uriFactory = $uriFactory ?: UriFactoryDiscovery::find();
        $this->messageFactory = $message ?: MessageFactoryDiscovery::find();
    }

    public function loadObject($iri): \stdClass
    {
        $document = $this->loadDocument((string) $iri);

        return JsonLD::compact(
            $document->document,
            [
                'documentLoader' => $this,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadDocument($url)
    {
        $uri = $this->uriFactory->createUri((string) $url);
        $request = $this->messageFactory->createRequest(
            'GET',
            $uri,
            [
                'Accept' => 'application/ld+json, application/json; q=0.9, */*; q=0.1',
            ]
        );

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (Throwable $e) {
            throw new JsonLdException(
                JsonLdException::LOADING_DOCUMENT_FAILED,
                "Unable to dereference resource IRI at $url",
                null,
                null,
                $e
            );
        }

        return new RemoteDocument(
            $url,
            Processor::parse((string) $response->getBody()),
            $response->getHeaderLine('Content-Type'),
            $response->getHeaderLine('Link') ?: null
        );
    }
}
