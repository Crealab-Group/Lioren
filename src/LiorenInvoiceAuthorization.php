<?php

namespace Crealab\Lioren;

use Crealab\Lioren\API;
use Crealab\Lioren\Entities\Invoice;

class LiorenInvoiceAuthorization extends API{

    /**
     * Request a CAF with a number of invoices
     * 
     * @param $data CAF information
     * @return \Crealab\Lioren\Entities\CAF
     */
    public function requestCAF(array $data){
        $response = $this->request('POST', 'cafs' , $data);
        return $this->transformIntoEntity( CAF::class , $response );
    }

    /**
     * Get a specific CAF with ID
     * 
     * @param $data CAF information
     * @return \Crealab\Lioren\Entities\CAF
     */
    public function CAF(array $data){
        $response = $this->request('GET', 'cafs' , $data);
        return $this->transformIntoEntity( CAF::class , $response );
    }

    /**
     * Obtain the index of CAFs
     * 
     * @param 
     * @return
     */
    public function indexCAFs(){
        //$response = $this->request('GET', 'cafs' , $data);
        //Sin return de momento
    }

    /**
     * Get a specific invoice
     * 
     * @param
     * @return \Crealab\Lioren\Entities\Invoice
     */
    public function invoice(array $data){
        $response = $this->request('GET', 'folios' , $data);
        return $this->transformIntoEntity( Invoice::class , $response );
    }
}