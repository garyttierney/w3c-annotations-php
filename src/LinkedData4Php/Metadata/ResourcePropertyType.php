<?php

namespace LinkedData4Php\Metadata;

final class ResourcePropertyType
{
    const SCALAR = 'scalar';
    const RESOURCE = 'resource';
    const COLLECTION = 'collection';

    private function __construct()
    {
    }

    public static function types()
    {
        return [
            self::SCALAR,
            self::RESOURCE,
            self::COLLECTION,
        ];
    }
}
