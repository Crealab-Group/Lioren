<?php

namespace Crealab\Lioren\Entities;

use Crealab\Lioren\Entity;
use Crealab\Lioren\LiorenMisc;
use Crealab\Lioren\Relation;

class User extends Entity{
    public function __construct($data){
        parent::__construct($data);
    }

    public function bussines(){
        return new Relation( LiorenMisc::class, 'bussines' );
    }

}