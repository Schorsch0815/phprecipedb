<?php
class UnitTypeTest extends CDbTestCase
{
    public $fixtures= array(
        'unit_type'=>'UnitType',
    );

    public function testImproveCovering()
    {
        $newUnitType = new UnitType;

        $newUnitType->search();
        UnitType::attributeLabels();
    }
}