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

    public function getForm() {
        return new CForm(array(
//        return new CForm(array(
			'showErrorSummary'=>true,
			'elements'=>array(
				'name'=>array(
//					'hint'=>'Recipe name',
				),
				'description'=>array(
                    'type'=>'textarea',
//					'hint'=>'Short description of the recipe',
                    'rows'=>'5', 'cols'=>'40'
				),
				'quantity'=>array(
//					'hint'=>'Quantity of portion',
				),
                'unit_id'=>array(
                    'label'=>'Unit of quantity',
                    'type'=>'dropdownlist',
                    'items'=> Unit::getUnitOptions(),
                )
			),
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
