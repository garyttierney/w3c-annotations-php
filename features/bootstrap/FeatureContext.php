<?php

use Anno4Php\Model\Annotation;
use Anno4Php\Model\Ontology\OADM;
use Anno4Php\Serializer\AnnotationSerializer;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;

class FeatureContext implements Context
{
    /**
     * @var string
     */
    private $json;

    /**
     * @var Annotation
     */
    private $annotation;

    /**
     * @var AnnotationSerializer
     */
    private $serializer;

    public function __construct()
    {
        $this->serializer = new AnnotationSerializer();
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
        $this->annotation = $this->serializer->deserialize($this->json);
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
        switch($type) {
            case 'target':
            case 'targets':
                $nodes =  $this->annotation->getTargets();
                break;
            case 'body':
            case 'bodies':
                $nodes = $this->annotation->getTargets();
                break;
        }

        Assert::assertCount($expected, $nodes);
    }
}
