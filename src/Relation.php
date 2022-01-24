<?php

namespace Crealab\Lioren;

class Relation{
  
    private string $resolver;

    private string $method;

    private $foreignKey;

    private string $param;

    public function __construct( string $resolver , string $method ,$foreignKey = null, string $param = 'id')
    {
        $this->resolver = $resolver;
        $this->method = $method;
        $this->foreignKey = $foreignKey;
        $this->param = $param;
    }

    public function resolve( string $token ):mixed{
        $api = new $this->resolver;
        $api->authenticate( $token );
        $entities = $api->{$this->method}( $this->constructParamsArray() );
        $entities = $this->propagateToken( $token , $entities );
        return $entities;
    }

    private function propagateToken( $token, $data ){
        if ( is_iterable( $data )  ) {
            foreach ( $data as $resource ) {
                $resource->setToken( $token );
            }
        } else {
            $data->setToken( $token );
        }
        return $data;
    }

    private function constructParamsArray(){
        if( is_null( $this->foreignKey ) ){
            return [];
        }

        return [
            'query' => [
                $this->param => $this->foreignKey
            ]
        ];
    }

}