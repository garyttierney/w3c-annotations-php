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
use LinkedData4Php\Model\OA\Annotation;
use LinkedData4Php\Model\OA\Body\TextualBody;
use LinkedData4Php\Model\OA\Motivation;
use LinkedData4Php\Model\OA\Target\SpecificResource;
use LinkedData4Php\Model\Ontology\OADM;
use LinkedData4Php\ResourceManager;
use LinkedData4Php\Serializer\ResourceSerializerFactory;
use PHPUnit\Framework\Assert;

class FeatureContext implements Context
{
    /**
     * @var ResourceManager
     */
    private static $manager;

    /**
     * @var string
     */
    private $json;

    /**
     * @var Annotation
     */
    private $annotation;

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

        $serializerFactory = new ResourceSerializerFactory($metadataRegistry);
        self:: $manager = new ResourceManager($metadataRegistry, $serializerFactory->create());
    }

    /**
     * @Given the JSON is:
     */
    public function givenJson(PyStringNode $json)
    {
        $this->json = $json->getRaw();
    }

    /**
     * @When the annotation is parsed
     */
    public function parseAnnotation()
    {
        $this->annotation = self::$manager->parse($this->json, Annotation::class);
    }

    /**
     * @Then the motivation should be :motivation
     */
    public function motivationShouldBe(string $motivation)
    {
        Assert::assertEquals(OADM::NS($motivation), $this->annotation->getMotivation()->getId());
    }

    /**
     * @Then /^there should be (\d+) (bodies|body|targets|target)$/
     */
    public function bodyOrTargetCountShouldBe(int $expected, string $type)
    {
        switch ($type) {
            case 'target':
            case 'targets':
                $nodes = $this->annotation->getTargets();
                break;
            case 'body':
            case 'bodies':
                $nodes = $this->annotation->getTargets();
                break;
        }

        Assert::assertCount($expected, $nodes);
    }

    /**
     * @Then /^the (creator|generator) ([a-zA-Z]+) should be (.*)$/
     */
    public function creatorOrGeneratorPropertyShouldBe(string $type, string $property, $expectedValue)
    {
        $agent = $type === 'creator' ? $this->annotation->getCreator() : $this->annotation->getGenerator();

        switch ($property) {
            case 'name':
                $actualValue = $agent->getName();
                break;
            case 'homepage':
                $actualValue = $agent->getHomepage();
                break;
            case 'nickname':
                $actualValue = $agent->getNickname();
                break;
            case 'id':
                $actualValue = $agent->getId();
                break;
            default:
                throw new InvalidArgumentException("Invalid property: $property");
        }

        Assert::assertEquals($expectedValue, $actualValue);
    }
}
