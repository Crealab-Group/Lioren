<?php

namespace Crealab\Lioren;

use Crealab\Lioren\Contracts\Arrayable;
use ArrayAccess;

class Entity implements Arrayable , ArrayAccess{
    /**
     * Authentification token for the current instance
     * 
     * @var string
     * @access protected
     */
    protected string $token;
    
    /**
     * Data of the entity returned by Lioren API
     *
     * @var array
     * @access protected
     */
    protected array $data = [];

    /**
     * relations
     * 
     * @var array
     * @access protected
     */
    protected array $relations = [];


    public function __construct($data){
        $this->data = $data;
    }

    public function setToken(string $token):void{
        $this->token = $token;
    }

    /**
     * Get a data by key
     *
     * @param string The key data to retrieve
     * @access public
     */
    public function __get ($key):mixed {
        return $this->getAttribute($key);
    }

    /**
     * Assigns a value to the specified data
     *
     * @param string The data key to assign the value to
     * @param mixed  The value to set
     * @access public
     */
    public function __set($key,$value) {
        if( isset($this->relations[$key]) ){
            $this->relations[$key] = $value;
            return;
        }
        $this->data[$key]  = $value;
    }

    /**
     * Whether or not an data exists by key
     *
     * @param string An data key to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function __isset ($key) {
        return isset($this->data[$key]) || isset($this->relations[$key]);
    }

    /**
     * Unsets an data by key
     *
     * @param string The key to unset
     * @access public
     */
    public function __unset($key) {
        if( isset($this->data[$key]) ){
            unset($this->data[$key]);
        }
        if( isset($this->relations[$key]) ){
            unset($this->relations[$key]);
        }
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetSet($offset,$value) : void {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            if( isset($this->relations[$offset]) ){
                $this->relations[$offset] = $value;
            }else{
                $this->data[$offset] = $value;
            }
            
        }
    }

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function offsetExists($offset):bool {
        return isset($this->data[$offset]) || isset($this->relations[$offset]);
    }

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetUnset($offset):void {
        if ($this->offsetExists($offset)) {
            if( isset($this->data[$offset]) ){
                unset($this->data[$offset]);
            }else{
                unset($this->relations[$offset]);
            }
        }
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @access public
     * @return mixed
     * @abstracting ArrayAccess
     */
    public function offsetGet($offset) {
        if( !$this->offsetExists($offset) ){
            return null;
        }
        if( isset($this->data[$offset]) ){
            return $this->data[$offset];
        }
        return $this->relations[$offset];
    }

    public function toArray(){
        return  array_merge( $this->data , $this->relations ) ;
    }

    public function getAttribute( $key ){
        if(!$key){
            return null;
        }

        if( array_key_exists( $key, $this->data ) ){
            return $this->data[$key];
        }

        if( array_key_exists( $key, $this->relations ) ){
            return $this->relations[$key];
        }

        if( ! method_exists( $this, $key ) ){
            return null;
        }

        $relation = $this->$key();

        if($relation instanceof Relation){
            $data = $relation->resolve( $this->token );
            $this->relations[ $key ] = $data;
            return $data;
        }
        return null;
    }

}