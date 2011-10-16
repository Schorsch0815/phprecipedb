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
class IngredientStep
        extends CFormModel
{

    public $name;
    public $seqNo = 1;
    public $ingredients;

    public function rules()
    {
        return array(
            array('name', 'length', 'max' => 64),
            array('name', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('seqNo', 'numerical', 'integerOnly' => true, 'min' => 1),
            array('ingredients', 'safe'),
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
            'name' => 'Name of Step',
            'ingredients' => 'List of Ingredients',
        );
    }

    public function parseIngredients()
    {
        $zeilen = explode("\n", $this->ingredients);
        $splitIngredient = array();
        $replacePattern = array( '#n\. B\.#' );
        
        $zeilen = preg_replace( $replacePattern, '', $zeilen );
        
        for ($i = 0; $i < sizeof($zeilen); ++$i) {
            $preg_match = preg_match('#\s*([\d/\.,]+|\s*)\s*([\S]*|\s+)[\s]*(.*)[\s]*#', $zeilen[$i], $splitIngredient[$i]);
            
            // we have no number 
            if (0 == strlen($splitIngredient[$i][1]))
            {
                if (0 == strlen($splitIngredient[$i][3]))
                {
                    // and ingredient position is empty so copy unit to ingredient
                    $splitIngredient[$i][3] = $splitIngredient[$i][2];
                    $splitIngredient[$i][2] = '';
                }
                else             
                {
                    // but unit and ingredient are filled 
                    // so we accidently split the ingredient
                    $splitIngredient[$i][3] = $splitIngredient[$i][2] . ' ' . $splitIngredient[$i][3];
                    $splitIngredient[$i][2] = '';
                }
            }
            
            // just trim whitespaces at end
            $splitIngredient[$i][3] = trim( $splitIngredient[$i][3] );
        }

        for ($i = 0; $i < sizeof($splitIngredient); ++$i) {
            for ($j = 1; $j < sizeof($splitIngredient[$i]); ++$j) {
                printf(">>%s<<  ", $splitIngredient[$i][$j]);
            }
            echo "\n";
        }
        return $splitIngredient;
    }

}

