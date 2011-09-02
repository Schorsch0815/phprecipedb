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
    public $seqNo;
    public $numOfIngredients;
    public $ingredients=array();
    
    public function rules() {
		return array(
			array('name', 'required'),
			array('seqNo', 'numerical',  'integerOnly'=>true),
			array('numOfIngredients', 'numerical',  'integerOnly'=>true),
			array('ingredients[0]','safe'),
			array('ingredients', 'required'),
//			array('ingredient1', 'required')
		);
	}

    public function getForm() {
        
        $this->name = 'Ingredients';
        $this->seqNo = 1;
        $this->numOfIngredients = 10;

        $elements = array('name'=>array());
    
        for( $i = 0; $i <$this->numOfIngredients; ++$i)
        {
            $elements["ingredients[$i]"]=array('label'=>'');
        }
        $elements['seqNo']= array();
        
        printf( "<pre>" );
        var_dump( $elements );
        printf( "</pre>" );
   
		return new CForm(array(
			'showErrorSummary'=>true,
			'elements'=>$elements,
			'buttons'=>array(
				'submit'=>array(
					'type'=>'submit',
					'label'=>'Next'
				),
				'save_draft'=>array(
					'type'=>'submit',
					'label'=>'Save'
				)
			)
		), $this);
	}
}

