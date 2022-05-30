<?php

namespace Crealab\Lioren\Tests;

use PHPUnit\Framework\TestCase;
use Crealab\Lioren\Lioren;
use Crealab\Lioren\Entities\CAF;
use Crealab\Lioren\Entities\Invoice;

class LiorenInvoiceAuthorizationTest extends TestCase{
    protected function setUp():void{
        $this->lioren = Lioren::authenticate( $_ENV['LIOREN_TOKEN']  );
        $this->dataCAF = ['tipodoc'=>'39','cantidad'=>100];
        $this->dataInvoce = ['tipodoc'=>'39', 'folio'=>1];
    }
    
    public function testInvoice(){
        $invoice = $this->lioren->invoice($this->dataInvoce);
        $this->assertInstanceOf(Invoice::class, $invoice);
    }

    public function testRequestCAF(){
        $rCAF = $this->lioren->requestCAF($this->dataCAF);
        $this->assertInstanceOf(CAF::class, $rCAF);
    }
 
    public function testCAF(){
        $caf = $this->lioren->CAF();
        $this->assertInstanceOf(CAF::class, $caf);
    }
}