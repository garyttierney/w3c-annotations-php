<?php

namespace LinkedData4Php\Loader;

use Exception;
use Throwable;

class ResourceLoaderException extends Exception
{
    public function __construct($message, Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
