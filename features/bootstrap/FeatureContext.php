<?php

use Behat\Behat\Context\Context;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Behat\Gherkin\Node\PyStringNode;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use LinkedData4Php\CodeGen\ResourceCodeGenerator;
use LinkedData4Php\Metadata\ResourceMetadataFactory;
use LinkedData4Php\Metadata\ResourceMetadataRegistry;
use LinkedData4Php\Model\Agent;
use LinkedData4Php\Model\IIIF\Canvas;
use LinkedData4Php\Model\IIIF\Manifest;
use LinkedData4Php\Model\IIIF\Sequence;
use LinkedData4Php\Model\OA\Annotation;
use LinkedData4Php\Model\OA\Body\TextualBody;
use LinkedData4Php\Model\OA\Motivation;
use LinkedData4Php\Model\OA\Target\SpecificResource;
use LinkedData4Php\ResourceManager;
use LinkedData4Php\Serializer\ResourceSerializerFactory;

class FeatureContext implements Context
{
    use IiifTrait;
    use OpenAnnotationTrait;

    /**
     * @Given the JSON is:
     */
    public function givenJson(PyStringNode $json)
    {
        $this->json = $json->getRaw();
    }

    /**
     * @BeforeSuite
     */
    public static function prepare(BeforeSuiteScope $scope)
    {
        AnnotationRegistry::registerLoader('class_exists');

        $annotationReader = new AnnotationReader();
        $metadataFactory = new ResourceMetadataFactory($annotationReader);
        $codeGen = new ResourceCodeGenerator($annotationReader);

        $metadataRegistry = new ResourceMetadataRegistry($metadataFactory, $codeGen);
        $metadataRegistry->register(Annotation::class);
        $metadataRegistry->register(Agent::class);
        $metadataRegistry->register(TextualBody::class);
        $metadataRegistry->register(SpecificResource::class);
        $metadataRegistry->register(Motivation::class);
        $metadataRegistry->register(Manifest::class);
        $metadataRegistry->register(Sequence::class);
        $metadataRegistry->register(Canvas::class);

        $serializerFactory = new ResourceSerializerFactory($metadataRegistry);
        self:: $manager = new ResourceManager($metadataRegistry, $serializerFactory->create());
    }
}
