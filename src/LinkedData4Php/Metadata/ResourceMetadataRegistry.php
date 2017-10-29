<?php

namespace LinkedData4Php\Metadata;

use LinkedData4Php\CodeGen\ResourceCodeGenerator;

class ResourceMetadataRegistry
{
    /**
     * @var ResourceMetadataFactory
     */
    private $factory;

    /**
     * @var ResourceCodeGenerator
     */
    private $codeGenerator;

    /**
     * @var ResourceMetadata[]
     */
    private $resourceMetadata = [];

    /**
     * @var ResourceMetadata[]
     */
    private $resourceMetadataByClass = [];

    /**
     * @var string[]
     */
    private $resourceImplClasses;

    /**
     * ResourceMetadataRegistry constructor.
     *
     * @param ResourceMetadataFactory $factory
     * @param ResourceCodeGenerator   $codeGenerator
     */
    public function __construct(ResourceMetadataFactory $factory, ResourceCodeGenerator $codeGenerator)
    {
        $this->factory = $factory;
        $this->codeGenerator = $codeGenerator;
    }

    public function register(string $type)
    {
        $metadata = $this->factory->create($type);
        $code = $this->codeGenerator->generateCode($metadata);

        //@todo - write to file and register with autoloader
        $code->load();

        $this->resourceMetadata[$metadata->getIri()] = $metadata;
        $this->resourceMetadataByClass[$metadata->getClassName()] = $metadata;
        $this->resourceImplClasses[$metadata->getClassName()] = $code->getFqName();
    }

    public function getImplementationClass(string $type)
    {
        $metadata = $this->getMetadata($type);
        $class = $metadata->getClassName();

        return $this->resourceImplClasses[$class];
    }

    public function supports(string $type): bool
    {
        return isset($this->resourceMetadata[$type]) || isset($this->resourceMetadataByClass[$type]);
    }

    public function getMetadata(string $type): ResourceMetadata
    {
        return $this->resourceMetadata[$type] ?? $this->resourceMetadataByClass[$type];
    }
}
