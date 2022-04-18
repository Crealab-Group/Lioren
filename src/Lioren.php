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
    /**
     * Lioren autheification Token
     * 
     * @var string $token
     * @see https://www.lioren.cl/docs#/api-auth
     */
    private string $token;

    /**
     * Specifics Implementations of Lioren API
     * @var array $instaceArray
     */
    private array $instanceArray = [
        LiorenMisc::class,
        LiorenDocuments::class,
        LiorenHonorsTickets::class,
        LiorenInventory::class,
        LiorenInvoiceAuthorization::class
    ];

    /**
     * @param string $token Lioren API Token
     */
    public function __construct(string $token){
        $this->token = $token;
    }

    /**
     * Creates a new instance of Lioren with a given token
     * 
     * @param string $token Lioren API Token
     * @return \Crealab\Lioren\Lioren
     */
    public static function authenticate(string $token):Lioren{
        return new self($token);
    }

    /**
     * Resolve a call with the especific implementation
     * 
     * @param string $method method name
     * @return \Crealab\Lioren\API
     */
    private function resolveInstance( string $method ):API{
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

    /**
     * Creates a specific implementation for a given method and call it
     * 
     * @param string name 
     */
    public function __call($name, $arguments){
        $instance = $this->resolveInstance($name);
        try {
            return ($instance->authenticate( $this->token ))->$name( ...$arguments );
        } catch (Throwable $th) {
            throw new MethodNotCallableException($name , $instance , $th);
        }
    }
}