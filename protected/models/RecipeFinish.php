<?php

/**
 * RecipeStartForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class RecipeFinish extends CFormModel
{
    public $comment = '';
	public $attributes = array();
	
    public function rules()
    {
        return array(array('comment', 'length', 'max' => 64));
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array();
    }

}
