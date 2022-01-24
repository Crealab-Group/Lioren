<?php

namespace Crealab\Lioren\Exceptions;

use Exception;

class MethodNotCallableException extends Exception{
    public function __construct($method , $instance , $previous)
    {
        $className = get_class($instance);
        parent::__construct("Method {$method} could not be called in {$className}",500 , $previous);
    }
}