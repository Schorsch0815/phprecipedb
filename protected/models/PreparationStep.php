<?php
/**
 * PreparationStepForm class.
 * PreparationStepForm is the data structure for keeping
 * one preparation step form data.
 *
 */
/*
 * @property integer $id
 * @property string $name
 * @property integer $seq_no
 * @property integer $recipe_id

 */

class PreparationStep extends CFormModel
{
    public $name;
    public $seqNo = 1;
    public $description;
    public $isLastStep = true;

    public function rules()
    {
        return array(
                array('description', 'required' ),
                array('seqNo', 'numerical', 'integerOnly' => true, 'min' => 1),
                array('name, description', 'filter',
                        'filter' => array($obj = new CHtmlPurifier(), 'purify')),
                array('name', 'length', 'max' => 64),
                array('description', 'length', 'max' => 256),
                array('isLastStep', 'safe'),);
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array('name' => 'Name of Step', 'description' => 'Description',);
    }

}

