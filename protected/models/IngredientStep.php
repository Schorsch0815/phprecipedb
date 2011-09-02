<?php
/**
 * IngredientStepForm class.
 * IngredientStepForm is the data structure for keeping
 * one ingredient step form data. 
 * 
 */
/*
 * @property integer $id
 * @property string $name
 * @property integer $seq_no
 * @property integer $recipe_id

 */
class IngredientStep extends CFormModel {
    public $name;
    public $seqNo = 1;
    public $ingredients;
    
    public function rules() {
		return array(
			array('seqNo', 'safe'),
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
			'name'=>'Name of Step',
			'ingredients'=>'List of Ingredients',
		);
	}

}
