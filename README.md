[![Build Status](https://travis-ci.org/garyttierney/w3c-annotations-php.svg?branch=master)](https://travis-ci.org/garyttierney/w3c-annotations-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/garyttierney/w3c-annotations-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/garyttierney/w3c-annotations-php/?branch=master)

# LinkedData4Php

LinkedData4Php is a PHP library for working with JSON-LD and other forms of linked
data used in the semantic web.  It features a JSON-LD mapper, which converts JSON-LD
to object graphs conforming to a given PHP interface. 

## Dependencies

LinkedData4Php relies on the following packages:

* [symfony/serializer](https://github.com/symfony/serializer) - A generic serializer/deserializer implementation.
* [httplug](https://github.com/php-http/httplug) - A pluggable HTTP client implementation.
* [doctrine/annotations](https://github.com/doctrine/annotations) - Annotation reader for PHP docblocks.
* [ml/json-ld](https://github.com/lanthaler/JsonLD) - A conforming JSON-LD processor.
* [beberlei/assert](https://github.com/beberlei/assert) - A library for runtime assertions.

## License
```
Copyright (c) 2017 Gary Tierney <gary.tierney@gmx.com>

Permission to use, copy, modify, and distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
```