Feature: IIIF Presentation API Viewing Hints

  Scenario:
    Given the JSON is:

    """
    {
      "@context":"http://iiif.io/api/presentation/2/context.json",
      "@id":"http://www.example.org/iiif/book1/manifest",
      "@type":"sc:Manifest",

      "label": "Book 1",
      "metadata": [
        {"label":"Author", "value":"Anne Author"},
        {"label":"Published", "value": [
            {"@value": "Paris, circa 1400", "@language":"en"},
            {"@value": "Paris, environ 1400", "@language":"fr"}
          ]
        },
        {"label":"Source",
         "value": "<span>From: <a href=\"http://example.org/db/1.html\">Some Collection</a></span>"}
      ],
      "description":"A longer description of this example book. It should give some real information.",
      "thumbnail": {
        "@id": "http://www.example.org/images/book1-page1/full/80,100/0/default.jpg",
        "service": {
          "@context":"http://iiif.io/api/image/2/context.json",
          "@id":"http://www.example.org/images/book1-page1",
          "profile":"http://iiif.io/api/image/2/level1.json"
        }
      },

      "viewingDirection": "right-to-left",
      "viewingHint": "paged",

      "license":"http://www.example.org/license.html",
      "attribution":"Provided by Example Organization",
      "logo": "http://www.example.org/logos/institution1.jpg",

      "related":{
        "@id": "http://www.example.org/videos/video-book1.mpg",
        "format": "video/mpeg"
      },
      "seeAlso":"http://www.example.org/library/catalog/book1.xml",
      "within":"http://www.example.org/collections/books/",

      "sequences" : [
          {
            "@id":"http://www.example.org/iiif/book1/sequence/normal",
            "@type":"sc:Sequence",
            "label":"Current Page Order"

          }
      ]
    }
    """

    When the manifest is parsed
    Then the viewing hint should be paged