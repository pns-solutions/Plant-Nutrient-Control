<?php

namespace PNS;
include '../../core/functions.php';

use PHPUnit\Framework\TestCase;
class BeispielklasseTest extends TestCase {

    public function testValidateRegistration() {

        $params = [
          'ID' => '0',
          'NAME' => 'Niclas Jarowsky'
        ];

        $newTest = new Beispielklasse($params);

//        $errorArray = [];
        $isValid = $newTest->validateRegistration($errorArray);

//        if(!empty($errorArray)) {
//            error_to_phpunit_output($errorArray);
//        }

        $this->assertSame(true, $isValid);;
    }
}
