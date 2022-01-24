<?php

namespace Crealab\Lioren;

use Crealab\Lioren\Exceptions\TokenExpiredException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Throwable;

class API{
    /**
     * @var string The base url of the Lioren API.
     */
    private CONST BASE_URL = "https://www.lioren.cl/api/";

    /**
     * @var string The API access token obtained from lioren
     */
    private string $token;

    /**
     * @var Client The Guzzle HTTP Client
     */
    private Client $client;

    /**
     * Updates the access token used by the Client.
     * 
     * @param string $token Lioren access token.
     * @return void
     */
    public function authenticate(string $token){
        $this->token = $token;
        $this->createClient();
        return $this;
    }


    /**
     * Creates a new GuzzleHTTPCLient instance with
     * the default data to connect with Lioren
     * @return void
     */
    private function createClient(){
        $this->client = new Client([
            "base_uri" => self::BASE_URL,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->token}",
            ],
        ]);
    }

    /**
     * Makes a new Request to the Lioren API.
     * 
     * @param string $method HTTP method to use
     * @param string $url path to construct the endpoint to make the request. This path is gonna be concatenated to the BASE_URL
     * @param array $options options array for guzzle request
     * @link https://docs.guzzlephp.org/en/stable/request-options.html
     * @return mixed $response
     */
    protected function request(string $method, string $url, array $options = []){
        $response = null;
        try {
            $response = $this->client->request($method, $url, $options);
        } catch( RequestException $guzzleException  ){
            if($guzzleException->getResponse()->getStatusCode() == 401){
                throw new TokenExpiredException($guzzleException); 
            }
            throw $guzzleException;
        } catch (Throwable $th) {
            throw $th;
        }

        return json_decode( $response->getBody() );
    }

    /**
     * Transforms a data array into a given entity
     * 
     * @param string $entity represents the full class name of the entity
     * @param mixed $data data array or object returned by Lioren API
     * 
     * @return Entity
     */
    protected function transformIntoEntity(string $entity, $data){
        $data = (array)$data;
        $entity = new $entity( $data );
        $entity->setToken( $this->token );
        return $entity;
    }

    /**
     * Transforms a array of data arrays into a given entity
     * 
     * @param string $entity represents the full class name of the entity
     * @param array $data data array returned by Lioren API
     * 
     * @return array
     */
    protected function transformIntoEntityArray(string $entity, array $data){
        return array_map(function( $item ) use ( $entity ){
            return $this->transformIntoEntity($entity, (array)$item);
        }, $data);
    }

}