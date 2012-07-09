<?php

/**
 * This is the model class for table "tbl_recipe".
 *
 * The followings are the available columns in table 'tbl_recipe':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $quantity
 * @property integer $unit_id
 *
 * The followings are the available model relations:
 * @property IngredientSection[] $ingredientSections
 * @property PreparationStep[] $preparationSteps
 * @property Unit $unit
 */
class Recipe extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Recipe the static model class
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
		return 'tbl_recipe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
            array('description, quantity, unit_id', 'safe'),
			array('unit_id', 'numerical', 'integerOnly'=>true),
			array('quantity', 'numerical'),
			array('name', 'length', 'max'=>64),
			array('description', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, quantity, unit_id', 'safe', 'on'=>'search'),
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
			'ingredientSections' => array(self::HAS_MANY, 'IngredientSection', 'recipe_id'),
			'preparationSteps' => array(self::HAS_MANY, 'PreparationStep', 'recipe_id'),
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
			'name' => 'Name',
			'description' => 'Description',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('unit_id',$this->unit_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}