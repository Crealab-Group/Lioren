<?php

namespace Crealab\Lioren\Tests;

use PHPUnit\Framework\TestCase;
use Crealab\Lioren\Lioren;

class LiorenInvoiceAuthorizationTest extends TestCase{
    protected function setUp():void{
        $this->lioren = Lioren::authenticate( $_ENV['LIOREN_TOKEN']  );
    }
    
    public function testGetInvoices(){
        $cafs = $this->lioren->cafs();
        $this->assertInstanceOf(Invoice::class, $cafs);
    }
}