Feature: JSON-LD to RDF graph model
  Scenario: Annotation with motivation IRI
    Given the JSON is:

    """
      {
        "@context": "http://www.w3.org/ns/anno.jsonld",
        "id": "http://example.org/anno2",
        "type": "Annotation",
        "body": {
          "id": "http://example.org/analysis1.mp3",
          "format": "audio/mpeg",
          "language": "fr"
        },
        "target": {
          "id": "http://example.gov/patent1.pdf",
          "format": "application/pdf",
          "language": ["en", "ar"],
          "textDirection": "ltr",
          "processingLanguage": "en"
        },
        "motivation": "http://www.w3.org/ns/oa#tagging"
      }
    """

    When the annotation is parsed
    Then the motivation should be tagging

  Scenario: Annotation with motivation label
    Given the JSON is:

    """
      {
        "@context": "http://www.w3.org/ns/anno.jsonld",
        "id": "http://example.org/anno15",
        "type": "Annotation",
        "motivation": "bookmarking",
        "body": [
          {
            "type": "TextualBody",
            "value": "readme",
            "purpose": "tagging"
          },
          {
            "type": "TextualBody",
            "value": "A good description of the topic that bears further investigation",
            "purpose": "describing"
          }
        ],
        "target": "http://example.com/page1"
      }
    """

    When the annotation is parsed
    Then the motivation should be bookmarking

  Scenario: Annotation with multiple bodies and multiple targets
    Given the JSON is:

    """
      {
        "@context": "http://www.w3.org/ns/anno.jsonld",
        "id": "http://example.org/anno9",
        "type": "Annotation",
        "body": [
          "http://example.org/description1",
          {
            "type": "TextualBody",
            "value": "tag1"
          }
        ],
        "target": [
          "http://example.org/image1",
          "http://example.org/image2"
        ]
      }
    """

    When the annotation is parsed
    Then there should be 2 bodies
    And there should be 2 targets

  Scenario: Annotation with a single body and single target
    Given the JSON is:

    """
      {
        "@context": "http://www.w3.org/ns/anno.jsonld",
        "id": "http://example.org/anno20",
        "type": "Annotation",
        "canonical": "urn:uuid:dbfb1861-0ecf-41ad-be94-a584e5c4f1df",
        "via": "http://other.example.org/anno1",
        "body": {
          "id": "http://example.net/review1",
          "rights": "http://creativecommons.org/licenses/by/4.0/"
        },
        "target": "http://example.com/product1"
      }
    """

    When the annotation is parsed
    Then there should be 1 body
    And there should be 1 target
