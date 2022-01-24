<?php

namespace Crealab\Lioren\Tests;

use Crealab\Lioren\Entities\BranchOffice;
use Crealab\Lioren\Entities\Business;
use Crealab\Lioren\Entities\City;
use Crealab\Lioren\Entities\Commune;
use Crealab\Lioren\Entities\DispatchType;
use Crealab\Lioren\Entities\DocumentType;
use Crealab\Lioren\Entities\PaymentMethod;
use Crealab\Lioren\Entities\ReferenceReason;
use Crealab\Lioren\Entities\Region;
use Crealab\Lioren\Entities\TransferType;
use Crealab\Lioren\Entities\User;
use PHPUnit\Framework\TestCase;
use Crealab\Lioren\Lioren;

class LiorenMiscTest extends TestCase{
    protected $lioren;

    protected function setUp():void{
        $this->lioren = Lioren::authenticate( $_ENV['LIOREN_TOKEN']  );
    }
    
    public function testGetAuth(){
        $user = $this->lioren->auth();
        $this->assertInstanceOf(User::class, $user);
    }

    public function testGetBussines(){
        $business = $this->lioren->bussines();
        $businessFromRelation = $this->lioren->auth()->bussines;
        $this->assertInstanceOf(Business::class, $business);
        $this->assertInstanceOf(Business::class, $businessFromRelation);
        $this->assertEquals( $business, $businessFromRelation);
    }

    public function testGetRegions(){
        $regions = $this->lioren->regions();
        $this->assertContainsOnly( Region::class, $regions );
    }

    public function testGetCommunes(){
        $communes = $this->lioren->communes();
        $this->assertContainsOnly( Commune::class, $communes );
    }

    public function testGetCities(){
        $cities = $this->lioren->cities();
        $this->assertContainsOnly( City::class, $cities );
    }

    public function testGetPaymentMethods(){
        $paymentMethods = $this->lioren->paymentMethods();
        $this->assertContainsOnly( PaymentMethod::class, $paymentMethods );
    }

    public function testGetReferenceReasons(){
        $references = $this->lioren->referenceReasons();
        $this->assertContainsOnly( ReferenceReason::class, $references );
    }

    public function testGetDispatchTypes(){
        $dispatchTypes = $this->lioren->dispatchTypes();
        $this->assertContainsOnly( DispatchType::class , $dispatchTypes );
    }

    public function testGetTransferTypes(){
        $transferTypes = $this->lioren->transferTypes();
        $this->assertContainsOnly( TransferType::class, $transferTypes );
    }

    public function testGetBranchOffices(){
        $offices = $this->lioren->branchOffices();
        $this->assertContainsOnly( BranchOffice::class, $offices );
    }
}