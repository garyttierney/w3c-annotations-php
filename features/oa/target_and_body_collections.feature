Feature: Open Annotation body and target collections

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

