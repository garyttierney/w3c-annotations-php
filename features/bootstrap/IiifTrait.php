<?php


use LinkedData4Php\Model\IIIF\Manifest;
use LinkedData4Php\Model\Ontology\IIIFP;
use PHPUnit\Framework\Assert;

trait IiifTrait
{
    use ResourceTrait;

    /**
     * @var Manifest
     */
    private $manifest;

    /**
     * @When the manifest is parsed
     */
    public function parseManifest()
    {
        $this->manifest = self::$manager->parse($this->json, Manifest::class);
    }

    /**
     * @Then the viewing hint should be :viewingHint
     */
    public function viewingHintShouldBe(string $viewingHint)
    {
        Assert::assertEquals(
            IIIFP::NS.$viewingHint.'Hint',
            $this->manifest->getViewingHint()
        );
    }
}
