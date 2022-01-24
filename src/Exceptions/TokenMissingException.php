<?php

namespace Crealab\Lioren\Exceptions;

use Exception;

class TokenMissingException extends Exception{
    public function __construct()
    {
        parent::__construct("Lioren token missing",500);
    }
}