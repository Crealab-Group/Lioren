<?php

namespace Crealab\Lioren\Exceptions;

use Exception;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class TokenExpiredException extends Exception{
    private Response $response; 
    
    public function __construct(RequestException $e){
        parent::__construct("Expired Lioren Token", 401, $e);
        $this->response = $e->getResponse();
    }

    public function getResponse(){
        return $this->response;
    }
}