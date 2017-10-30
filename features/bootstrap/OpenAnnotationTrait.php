<?php


use LinkedData4Php\Model\OA\Annotation;
use LinkedData4Php\Model\Ontology\OADM;
use PHPUnit\Framework\Assert;

trait OpenAnnotationTrait
{
    use ResourceTrait;

    /**
     * @var Annotation
     */
    private $annotation;

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
        $agent = 'creator' === $type ? $this->annotation->getCreator() : $this->annotation->getGenerator();

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
