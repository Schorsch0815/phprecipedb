<?php

require_once("FirePHPCore/FirePHP.class.php");
require_once('FirePHPCore/fb.php');

class UnitTest extends CDbTestCase
{
    public static function setUpBeforeClass()
    {
        FB::setEnabled(false);
    }

    public function testGermanPhonetic()
    {
        $this->assertEquals( 0, Utilities::germanphonetic( "Ei" ));
    }
}
