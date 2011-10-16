<?php

/**
 * This is the model class for table "tbl_ingredient_entry".
 *
 * The followings are the available columns in table 'tbl_ingredient_entry':
 * @property integer $id
 * @property integer $ingredient_section_id
 * @property integer $ingredient_section_recipe_id
 * @property integer $ingredient_id
 * @property double $quantity
 * @property integer $unit_id
 *
 * The followings are the available model relations:
 * @property Ingredient $ingredient
 * @property IngredientSection $ingredientSection
 * @property Unit $unit
 */
class IngredientEntry
        extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return IngredientEntry the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_ingredient_entry';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ingredient_section_id, ingredient_section_recipe_id, ingredient_id, unit_id', 'required'),
            array('ingredient_section_id, ingredient_section_recipe_id, ingredient_id, unit_id', 'numerical', 'integerOnly' => true),
            array('quantity', 'numerical'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, ingredient_section_id, ingredient_section_recipe_id, ingredient_id, quantity, unit_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ingredient' => array(self::BELONGS_TO, 'Ingredient', 'ingredient_id'),
            'ingredientSection' => array(self::BELONGS_TO, 'IngredientSection', 'ingredient_section_id'),
            'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'ingredient_section_id' => 'Ingredient Section',
            'ingredient_section_recipe_id' => 'Ingredient Section Recipe',
            'ingredient_id' => 'Ingredient',
            'quantity' => 'Quantity',
            'unit_id' => 'Unit',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ingredient_section_id', $this->ingredient_section_id);
        $criteria->compare('ingredient_section_recipe_id', $this->ingredient_section_recipe_id);
        $criteria->compare('ingredient_id', $this->ingredient_id);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('unit_id', $this->unit_id);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

}