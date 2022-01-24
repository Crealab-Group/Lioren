<?php

namespace Crealab\Lioren\Exceptions;

use Exception;

class MethodNotFoundException extends Exception{
    public function __construct()
    {
        parent::__construct("Method not found",500);
    }
}