<?php

namespace Crealab\Lioren;

use Crealab\Lioren\API;
use Crealab\Lioren\Entities\Invoice;
use Crealab\Lioren\Entities\CAF;

class LiorenInvoiceAuthorization extends API{

    /**
     * Request a CAF with a number of invoices
     * 
     * @example Lioren::authenticate($apiKey)->requestCAF($request);
     * @see https://www.lioren.cl/docs#/api-cafs
     * 
     * @param $data CAF information
     * @return \Crealab\Lioren\Entities\CAF
     * 
     * @author Juan Carlos Saavedra <juancarlosf.saavedrap@gmail.com>
     */
    public function requestCAF(array $data){
        $response = $this->request('POST', 'cafs' , ['form_params' =>$data]);
        return $this->transformIntoEntity( CAF::class , $response );
    }

    /**
     * Get a specific CAF with ID
     * 
     * @example
     * @see https://www.lioren.cl/docs#/api-cafs
     * 
     * @param $data CAF information
     * @return \Crealab\Lioren\Entities\CAF
     * 
     * @author Juan Carlos Saavedra <juancarlosf.saavedrap@gmail.com>
     */
    public function CAF(array $data){
        $response = $this->request('GET', 'cafs' , ['form_params' =>$data]);
        return $this->transformIntoEntity( CAF::class , $response );
    }

    /**
     * Get a specific invoice
     * 
     * @example
     * @see https://www.lioren.cl/docs#/api-cafs
     * 
     * @param $data Invoice information
     * @return \Crealab\Lioren\Entities\Invoice
     * 
     * @author Juan Carlos Saavedra <juancarlosf.saavedrap@gmail.com>
     */
    public function invoice(array $data){
        $response = $this->request('GET', 'folios' , ['form_params' =>$data]);
        return $this->transformIntoEntity( Invoice::class , $response );
    }

    /**
     * Obtain the index of CAFs
     * 
     * @example
     * @see https://www.lioren.cl/docs#/api-cafs
     * 
     * @param 
     * @return
     * 
     * @author Juan Carlos Saavedra <juancarlosf.saavedrap@gmail.com>
     */
    public function indexCAFs(){
        //$response = $this->request('GET', 'cafs' , $data);
        //Was put on hold
    }
}