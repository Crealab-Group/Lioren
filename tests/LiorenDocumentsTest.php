<?php

namespace Crealab\Lioren\Tests;

use PHPUnit\Framework\TestCase;
use Crealab\Lioren\Lioren;

class LiorenDocumentsTest extends TestCase{
    protected function setUp():void{
        $this->lioren = Lioren::authenticate( $_ENV['LIOREN_TOKEN']  );
    }
    
    public function testGetDocumentTypes(){
        $documents = $this->lioren->documentTypes();
        //$this->assertContainsOnly( DocumentType::class, $documents );
        $this->assertNotCount(0, $documents);
    }
    
    //Lo demás se paga .__.
}