<?php

namespace Crealab\Lioren\Tests;

use PHPUnit\Framework\TestCase;
use Crealab\Lioren\Lioren;
use Crealab\Lioren\Entities\CAF;

class LiorenInvoiceAuthorizationTest extends TestCase{
    protected function setUp():void{
        $this->lioren = Lioren::authenticate( $_ENV['LIOREN_TOKEN']  );
        $this->data = ['tipodoc'=>'39','cantidad'=>100];
    }
    
    public function testInvoice(){
        $invoice = $this->lioren->invoice();
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    public function testRequestCAF(){
        $rCAF = $this->lioren->requestCAF($this->data);
        $this->assertInstanceOf(CAF::class, $rCAF);
    }
 
    public function testCAF(){
        $caf = $this->lioren->CAF();
        $this->assertInstanceOf(CAF::class, $caf);
    }
}