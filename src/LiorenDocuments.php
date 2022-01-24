<?php

namespace Crealab\Lioren;

use Crealab\Lioren\API;
use Crealab\Lioren\Entities\DocumentType;
use Crealab\Lioren\Entities\DTE;
use Crealab\Lioren\Entities\Ticket;

class LiorenDocuments extends API{
    
    public function documentTypes( array $options = [] ){
        $dataArray = $this->request('GET', 'tipodocs' , $options);
        return $this->transformIntoEntityArray( DocumentType::class, $dataArray->tipodocs );
    }
    
    public function emitDTE(array $data , array $options = []){
        $response = $this->request('POST', 'dtes' , array_merge( $options, $data ) );
        return $this->transformIntoEntity( DTE::class , $response );
    }   

    public function dtes( array $options = [] ){
        $response = $this->request('POST', 'dtes' , $options );
        return $this->transformIntoEntityArray( DTE::class , $response );
    }

    public function emitTicket( array $data , array $options = [] ){
        $response = $this->request('POST', 'boletas' , array_merge( $options, $data ) );
        return $this->transformIntoEntity( Ticket::class , $response );
    }

    public function tickets( array $options = [] ){
        $response = $this->request('GET', 'boletas' , $options);
        return $this->transformIntoEntity( Ticket::class , $response);
    }    
}