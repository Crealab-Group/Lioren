<?php

namespace Crealab\Lioren;

use Crealab\Lioren\API;
use Crealab\Lioren\Entities\DocumentType;
use Crealab\Lioren\Entities\DTE;
use Crealab\Lioren\Entities\Ticket;

class LiorenDocuments extends API{
    /**
     * Get the documents types from Lioren API
     * 
     * @param array $options Option array for Guzzle Request
     * @return array array of \Crealab\Lioren\Entities\DocumentType
     */
    public function documentTypes( array $options = [] ):array{
        $dataArray = $this->request('GET', 'tipodocs' , $options);
        return $this->transformIntoEntityArray( DocumentType::class, $dataArray->tipodocs );
    }
    
    /**
     * Post to emit a new DTE via Lioren
     * 
     * @param array $data DTE information
     * @param array $options Option array for Guzzle Request
     * @return \Crealab\Lioren\Entities\DTE
     */
    public function emitDTE(array $data , array $options = []){
        $response = $this->request('POST', 'dtes' , array_merge( $options, $data ) );
        return $this->transformIntoEntity( DTE::class , $response );
    }   

    /**
     * Obtain the index of emited DTE's
     *
     * @param array $options Option array for Guzzle Request
     * @return array 
     */
    public function dtes( array $options = [] ){
        $response = $this->request('POST', 'dtes' , $options );
        return $this->transformIntoEntityArray( DTE::class , $response );
    }

    /**
     * Emit a new ticket via Lioren
     * 
     * @param array $data Ticket information
     * @param array $options Option array for Guzzle Request
     * @return \Crealab\Lioren\Entities\Ticket
     */
    public function emitTicket( array $data , array $options = [] ){
        $response = $this->request('POST', 'boletas' , array_merge( $options, $data ) );
        return $this->transformIntoEntity( Ticket::class , $response );
    }

    /**
     * Index the emited tickets
     * 
     * @param array $options Option array for Guzzle Request
     * @return array
     */
    public function tickets( array $options = [] ){
        $response = $this->request('GET', 'boletas' , $options);
        return $this->transformIntoEntity( Ticket::class , $response);
    }    
}