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
    public $parsedIngredients;
    public $ingredientsArray;
    public $isParsed = false;
    public $isLastStep = true;

    public function rules()
    {
        return array(
            array('name', 'length', 'max' => 64),
            array('name', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('seqNo', 'numerical', 'integerOnly' => true, 'min' => 1),
            array('ingredients', 'safe'),
            array('parsedIngredients', 'safe'),
            array('ingredientsArray', 'safe'),
            array('isParsed', 'safe'),
            array('isLastStep', 'safe'),
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

    public function validateIngredients()
    {
        $ingredients = $this->parseIngredients();
        
        if (NULL == $ingredients)
            return false;
        
        $this->parsedIngredients = array();

        $connection = Yii::app()->db;

        for ($i = 0; $i < sizeof($ingredients); ++$i)
        {
            $row = array();
            
            $row[] = $ingredients[$i][1]; // quantity of ingredient

            FB::log($row);

            // search unit for quantitiy
            $lPossibleUnits = $connection->createCommand()->select('id,short_desc')
                    ->from('tbl_unit')
                    ->where('short_desc=:name or description=:name', array(':name' => $ingredients[$i][2]))
                    ->queryAll();
            
            if (sizeof($lPossibleUnits) > 0)
            {
                // we found exact match in database
                // append ingredient array for dropbox
                $row[] = array( $lPossibleUnits[0]['id'] => $lPossibleUnits[0]['short_desc'] );
            }
            else
            {
                $row[] = array( 0 => $ingredients[$i][2] ); // unit for quantity
            }
            
            // search ingredients (native, phonetics or new)
            $lPossibleIngredients = $connection->createCommand()->select('id,name,unit_usage')
                    ->from('tbl_ingredient')
                    ->where('name=:name', array(':name' => $ingredients[$i][3]))
                    ->queryAll();
            if (sizeof($lPossibleIngredients) > 0)
            {
                // we found exact match in database
                // append ingredient array for dropbox
                $row[] = array( $lPossibleIngredients[0]['id'] => $lPossibleIngredients[0]['name'] );
            }
            else
            {
                // now search for matching soundex and/or germany phonetics
                $curSoundEx = soundex($ingredients[$i][3]);
                $curGermanPhon = Utilities::germanphonetic($ingredients[$i][3]) . '%';

                $lPossibleIngredients = $connection->createCommand()->selectDistinct('id,name,unit_usage')
                        ->from('tbl_ingredient')
                        ->where('soundex_code = :soundex_code OR cologne_phony_code like :cologne_phony_code', 
                                array(':soundex_code' => $curSoundEx, ':cologne_phony_code' => $curGermanPhon))
                        ->queryAll();
                if (sizeof($lPossibleIngredients) > 0)
                {
                    // we found a matching soundex or german phonectics
                    $lTmp = array();
                    
                    // add the entered ingredient
                    $lTmp[0] = $ingredients[$i][3];
                    
                    // now add the entries from db
                    for ($j = 0; $j < sizeof($lPossibleIngredients); ++$j)
                    {   
                        $lTmp[$lPossibleIngredients[$j]['id']] = $lPossibleIngredients[$j]['name'];
                    }

                    $row[] = $lTmp;
                }
                else
                {
                    // this seems to be a new ingredient
                    $row[] = array( 0 => $ingredients[$i][3] );
                }
            }
            $this->parsedIngredients[] = $row;
        }
        
        return true;
    }

    public function parseIngredients()
    {
        // explode string
        $rowArray = array_filter( explode("\n", $this->ingredients) );
        $parsedIngreds = array();
        
        // remove strin "n. B." from input
        $replacePattern = array( '#n\. B\.#' );
        $rowArray = preg_replace( $replacePattern, '', $rowArray );

        // remove empty lines
        $rowArray = array_filter( $rowArray, array( "Utilities", "isStringNotEmpty" ) );

        if (0 == sizeof($rowArray))
            return NULL;
        
        $i = 0;
        foreach ($rowArray as $row)
        {
            $resultPregMatch = preg_match('#\s*([\d/\.,]+|\s*)\s*([\S]*|\s+)[\s]*(.*)[\s]*#', $row, $parsedIngreds[$i]);
            
            if ($resultPregMatch > 0)
            {
                // we have no number 
                if (0 == strlen($parsedIngreds[$i][1]))
                {
                    if (0 == strlen($parsedIngreds[$i][3]))
                    {
                        // and ingredient position is empty so copy unit to ingredient
                        $parsedIngreds[$i][3] = $parsedIngreds[$i][2];
                        $parsedIngreds[$i][2] = '';
                    }
                    else             
                    {
                        // but unit and ingredient are filled 
                        // so we accidently split the ingredient
                        $parsedIngreds[$i][3] = $parsedIngreds[$i][2] . ' ' . $parsedIngreds[$i][3];
                        $parsedIngreds[$i][2] = '';
                    }
                }
                else
                {
                    if (0 == strlen($parsedIngreds[$i][3]))
                    {
                        // we have a number but ingredient seems to be empty
                        // then we expect to have no unit
                        $parsedIngreds[$i][3] = $parsedIngreds[$i][2];
                        $parsedIngreds[$i][2] = '';
                    }
                }

                // just trim whitespaces at end
                $parsedIngreds[$i][3] = trim( $parsedIngreds[$i][3] );
            }
            // increase parsedIngreds index
            ++$i;
        }
        return $parsedIngreds;
    }

    public function unparseIngredients()
    {
        $this->ingredients = '';
        
        foreach ($this->parsedIngredients as $ingredientData) {
            FB::log( $ingredientData );
            $this->ingredients .= ('' == $ingredientData[0]) ? '' : ($ingredientData[0] . ' ');
            $this->ingredients .= ('' == array_shift(array_values($ingredientData[1]))) ? '' :  (array_shift(array_values($ingredientData[1])) . ' ');
            $this->ingredients .= array_shift(array_values($ingredientData[2])) . "\n";
        }
    }
}

