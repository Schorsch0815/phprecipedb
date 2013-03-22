<?php

/**
 * This is the model class for table "tbl_ingredient".
 *
 * The followings are the available columns in table 'tbl_ingredient':
 * @property integer $id
 * @property string $name
 * @property integer $unit_usage
 *
 * The followings are the available model relations:
 * @property IngredientEntry[] $ingredientEntries
 */
class Ingredient extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return Ingredient the static model class
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
        return 'tbl_ingredient';
    }

    /**
     * This method ensures that the new entered unit is not a base unit
     * Enter description here ...
     */
    protected function afterValidate()
    {
        if ($this->isNewRecord) {
            // it's not allowed to create new base units
            // ( base units has to be defined as base line setup)
            $this->cologne_phony_code = Utilities::germanphonetic($this->name);
            $this->soundex_code = soundex($this->name);
        }
        return parent::afterValidate();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(array('name', 'required'),
                array('name', 'length', 'max' => 64),
                array('unit_usage', 'numerical', 'integerOnly' => true),
                array('cologne_phony_code, soundex_code', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, unit_usage', 'safe', 'on' => 'search'),);
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
                        'ingredient_id'),);
    }

	/**
	 * @return label of model
     */
	public static function label($n = 1) {
		return Yii::t('app', 'Ingredient|Ingredients', $n);
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('id' => Yii::t('app', 'ID'), 'name' => Yii::t('app', 'Name'),
                'unit_usage' => Yii::t('app', 'Unit usage'),);
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
        $criteria->compare('unit_usage', $this->unit_usage);

        return new CActiveDataProvider(get_class($this),
            array('criteria' => $criteria,));
    }

}
