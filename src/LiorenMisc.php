<?php

namespace Crealab\Lioren;

use Crealab\Lioren\API;
use Crealab\Lioren\Entities\BranchOffice;
use Crealab\Lioren\Entities\Business;
use Crealab\Lioren\Entities\Commune;
use Crealab\Lioren\Entities\DispatchType;
use Crealab\Lioren\Entities\PaymentMethod;
use Crealab\Lioren\Entities\ReferenceReason;
use Crealab\Lioren\Entities\Region;
use Crealab\Lioren\Entities\City;
use Crealab\Lioren\Entities\TransferType;
use Crealab\Lioren\Entities\User;

class LiorenMisc extends API{
    public function auth( array $options = [] ){
        $data = $this->request("GET", "whoami" , $options);
        return $this->transformIntoEntity( User::class , $data );
    }

    public function bussines( array $options = [] ){
        $data = $this->request("GET", "miempresa", $options);
        return $this->transformIntoEntity( Business::class, $data);
    }

    public function regions( array $options = [] ){
        $dataArray = $this->request("GET", "regiones" , $options);
        return $this->transformIntoEntityArray( Region::class , $dataArray );
    }

    public function communes( array $options = [] ){
        $dataArray = $this->request("GET", "comunas", $options);
        return $this->transformIntoEntityArray( Commune::class, $dataArray );
    }

    public function cities( array $options = [] ){
        $dataArray = $this->request("GET", "ciudades", $options);
        return $this->transformIntoEntityArray( City::class , $dataArray );
    }

    public function paymentMethods( array $options = [] ){
        $dataArray = $this->request("GET", "mediopagos" , $options);
        return $this->transformIntoEntityArray( PaymentMethod::class , $dataArray->mediopagos);
    }

    public function referenceReasons( array $options = [] ){
        $dataArray = $this->request("GET", "razonesref", $options);;
        return $this->transformIntoEntityArray( ReferenceReason::class, $dataArray->razonesref );
    }

    public function dispatchTypes( array $options = [] ){
        $dataArray =  $this->request("GET", "tipodespachos" , $options);
        return $this->transformIntoEntityArray( DispatchType::class, $dataArray->tipodespachos );
    }

    public function transferTypes( array $options = [] ){
        $dataArray = $this->request("GET", "tipotraslados" , $options);
        return $this->transformIntoEntityArray( TransferType::class, $dataArray->tipotraslados );
    }

    public function branchOffices( array $options = [] ){
        $dataArray = $this->request("GET", "sucursales", $options);
        return $this->transformIntoEntityArray( BranchOffice::class, $dataArray->sucursales );
    }
}