<?php

require_once("FirePHPCore/FirePHP.class.php");
require_once('FirePHPCore/fb.php');

class UnitTest extends CDbTestCase
{
    public $fixtures = array('unit' => 'Unit',
                             'unit_type' => 'UnitType',);
    
    public static function setUpBeforeClass()
    {
        FB::setEnabled(false);
    }

    public function testCalcUsageBitMask()
    {
        $this->assertEquals( 8, Unit::calcUsageBitMask( 0 ));
        $this->assertEquals( 1, Unit::calcUsageBitMask( 1 ));
        $this->assertEquals( 2, Unit::calcUsageBitMask( 2 ));
        $this->assertEquals( 4, Unit::calcUsageBitMask( 3 ));
        $this->assertEquals( 1, Unit::calcUsageBitMask( 4 ));
    }
}
