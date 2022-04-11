<?php

namespace Crealab\Lioren;

use Crealab\Lioren\API;
use Crealab\Lioren\Entities\Invoice;

class LiorenInvoiceAuthorization extends API{

    public function getInvoices(array $data){
        $response = $this->request('POST', 'cafs' , $data);
        return $this->transformIntoEntity( Invoice::class , $response );
    }
}