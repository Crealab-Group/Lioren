<?php

namespace Crealab\Lioren\Entities;

use Crealab\Lioren\Entity;
use Crealab\Lioren\LiorenMisc;
use Crealab\Lioren\Relation;

class Region extends Entity{
    public function __construct($data){
        parent::__construct($data);
    }

    public function communes(){
        return new Relation(Commune::class, LiorenMisc::class, 'communes', $this->id, 'region_id');
    }

    public function cities(){
        return new Relation(City::class, LiorenMisc::class, 'cities',$this->id, 'region_id');
    }

}