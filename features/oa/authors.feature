Feature: Open Annotation authoring information

  Scenario: Annotation with creator body
    Given the JSON is:

    """
      {
        "@context": "http://www.w3.org/ns/anno.jsonld",
        "id": "http://example.org/anno9",
        "type": "Annotation",
        "creator": {
          "id": "http://example.org/user1",
          "type": "Person",
          "name": "A. Person",
          "nickname": "user1"
        },
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
    Then the creator name should be A. Person
    And the creator nickname should be user1
    And the creator id should be http://example.org/user1

  Scenario: Annotation with generator IRI
    Given the JSON is:

    """
      {
        "@context": "http://www.w3.org/ns/anno.jsonld",
        "id": "http://example.org/anno9",
        "type": "Annotation",
        "generator": "http://example.org/user1",
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
    Then the generator id should be http://example.org/user1