<?php
/**
 * PreperationStepForm class.
 * PreperationStepForm is the data structure for keeping
 * one preperation step form data. 
 * 
 */
/*
 * @property integer $id
 * @property string $name
 * @property integer $seq_no
 * @property integer $recipe_id

 */
class PreperationStep extends CFormModel {
    public $name;
    public $seqNo = 1;
    public $description;
    
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
			'description'=>'Description',
		);
	}

}

