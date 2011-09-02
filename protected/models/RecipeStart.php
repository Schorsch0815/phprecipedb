<?php
/**
 * RecipeStartForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RecipeStart extends CFormModel {
    public $name;
    public $description;
    public $quantity;
    public $unit_id;

    public function rules() {
		return array(
			array('name', 'required'),
            array('description', 'safe'),
			array('quantity', 'numerical', 'integerOnly'=>true),
			array('unit_id', 'numerical', 'integerOnly'=>true),
		);
	}

    /**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Recipe Name',
            'quantity'=>'Quantity or Number of Portions'
		);
	}
    
}