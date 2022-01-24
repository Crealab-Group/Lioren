<?php
namespace Crealab\Lioren;

use Crealab\Lioren\Exceptions\MethodNotCallableException;
use Crealab\Lioren\Exceptions\MethodNotFoundException;
use Crealab\Lioren\LiorenMisc;
use Crealab\Lioren\LiorenDocuments;
use Crealab\Lioren\LiorenHonorsTickets;
use Crealab\Lioren\LiorenInventory;
use Crealab\Lioren\LiorenInvoiceAuthorization;
use Throwable;

class Lioren{
    private string $token;

    private array $instanceArray = [
        LiorenMisc::class,
        LiorenDocuments::class,
        LiorenHonorsTickets::class,
        LiorenInventory::class,
        LiorenInvoiceAuthorization::class
    ];

    public function __construct(string $token){
        $this->token = $token;
    }

    public static function authenticate(string $token){
        return new self($token);
    }

    private function resolveInstance($method){
        $instance = null;
        foreach ($this->instanceArray as $instanceable) {
            if(method_exists( $instanceable , $method )){
                $instance = new $instanceable( );
                break;
            }
        }
        if(is_null($instance)){
            throw new MethodNotFoundException();
        }
        return $instance;
    }

    public function __call($name, $arguments){
        $instance = $this->resolveInstance($name);
        try {
            return ($instance->authenticate( $this->token ))->$name( ...$arguments );
        } catch (Throwable $th) {
            throw new MethodNotCallableException($name , $instance , $th);
        }
    }

}