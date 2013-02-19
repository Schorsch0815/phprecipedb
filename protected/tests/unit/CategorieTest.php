<?php

require_once("FirePHPCore/FirePHP.class.php");
require_once('FirePHPCore/fb.php');

class CategorieTest extends CDbTestCase
{
    public static function setUpBeforeClass()
    {
        FB::setEnabled(false);
    }

    public function testGetCategorieOptions()
    {
        print_r(Categorie::getCategoriesOptions() );
    }
    
    
}
