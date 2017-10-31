Feature: Open Annotations motivations

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
