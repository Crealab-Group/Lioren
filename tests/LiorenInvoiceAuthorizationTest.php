<?php

namespace Crealab\Lioren\Tests;

use PHPUnit\Framework\TestCase;
use Crealab\Lioren\Lioren;

class LiorenInvoiceAuthorizationTest extends TestCase{
    protected function setUp():void{
        $this->lioren = Lioren::authenticate( $_ENV['LIOREN_TOKEN']  );
    }
    
    public function testInvoice(){
        $invoice = $this->lioren->invoice();
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    public function testRequestCAF(){
        $rCAF = $this->lioren->requestCAF();
        $this->assertInstanceOf(CAF::class, $rCAF);
    }
 
    public function testCAF(){
        $caf = $this->lioren->CAF();
        $this->assertInstanceOf(CAF::class, $caf);
    }
}