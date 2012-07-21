<?php

/**
 * This is the model class for table "tbl_ingredient_section".
 *
 * The followings are the available columns in table 'tbl_ingredient_section':
 * @property integer $id
 * @property string $name
 * @property integer $seq_no
 * @property integer $recipe_id
 *
 * The followings are the available model relations:
 * @property IngredientEntry[] $ingredientEntries
 * @property Recipe $recipe
 */
class IngredientSection extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return IngredientSection the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_ingredient_section';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('seq_no, recipe_id', 'required'),
                array('seq_no, recipe_id', 'numerical', 'integerOnly' => true),
                array('name', 'length', 'max' => 64),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, seq_no, recipe_id', 'safe', 'on' => 'search'),);
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
                'ingredientEntries' => array(self::HAS_MANY, 'IngredientEntry',
                        'ingredient_section_id'),
                'recipe' => array(self::BELONGS_TO, 'Recipe', 'recipe_id'),);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('id' => 'ID', 'name' => 'Name', 'seq_no' => 'Seq No',
                'recipe_id' => 'Recipe',);
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('seq_no', $this->seq_no);
        $criteria->compare('recipe_id', $this->recipe_id);

        return new CActiveDataProvider(get_class($this),
            array('criteria' => $criteria,));
    }

}
