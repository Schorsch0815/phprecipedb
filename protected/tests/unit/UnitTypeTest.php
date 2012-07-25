<?php

require_once("FirePHPCore/FirePHP.class.php");
require_once('FirePHPCore/fb.php');

class UnitTypeTest extends CDbTestCase
{
    public $fixtures = array('unit_type' => 'UnitType',);

    public static function setUpBeforeClass()
    {
        FB::setEnabled(false);
    }

    public function testUnitTypeOptions()
    {
        $unitTypeOptions = UnitType::getUnitTypeOptions();

        $this->assertTrue(3 == count($unitTypeOptions));

        $this
            ->assertEquals(
                $unitTypeOptions[1],
                $this->unit_type['unitTypeWeight']['name']);
    }

    public function testImproveCovering()
    {
        $newUnitType = new UnitType;

        $newUnitType->search();
        UnitType::attributeLabels();
    }

    public function testListOptions()
    {
        $unitTypeOptions = UnitType::getUnitTypeOptions();

        var_dump($unitTypeOptions);
    }
}
