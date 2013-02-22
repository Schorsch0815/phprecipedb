<?php

require_once("FirePHPCore/FirePHP.class.php");
require_once('FirePHPCore/fb.php');

class RecipeTest extends CDbTestCase
{
    public $fixtures = array('unit' => 'Unit',
                             'unit_type' => 'UnitType',
                             'recipe' => 'Recipe',
                             'categorie' => 'Categorie',
            );
    
    public static function setUpBeforeClass()
    {
        FB::setEnabled(false);
    }

    public function testSaveRelations()
    {
        $recipe = new Recipe();
        
        $recipe->id = 1;
        $recipe->description = 'Nußkuchen';
        $recipe->name = 'Kuchen';
        $recipe->unit_id = 3;
        
        $recipe->categories = array( 6);
        
        $recipe->save();
        
        $result = Recipe::model()->findByPk( 1 );
        
        $this->assertEquals( 6, $result->categories[0]->id );
        $this->assertEquals( 'Kuchen', $result->categories[0]->description );
    }
}
