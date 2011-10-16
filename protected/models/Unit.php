<?php

/**
 * This is the model class for table "tbl_unit".
 *
 * The followings are the available columns in table 'tbl_unit':
 * @property integer $id
 * @property string $short_desc
 * @property string $description
 * @property integer $unit_type_id
 * @property integer $is_base_unit
 * @property double $base_unit_factor
 *
 * The followings are the available model relations:
 * @property IngredientEntry[] $ingredientEntries
 * @property Recipe[] $recipes
 * @property UnitType $unitType
 */
class Unit
        extends CActiveRecord
{

    public $mBaseUnit = null;

    /**
     * Returns the static model of the specified AR class.
     * @return Unit the static model class
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
        return 'tbl_unit';
    }

    /**
     * This method ensures that the new entered unit is not a base unit
     * Enter description here ...
     */
    protected function beforeValidate()
    {
        if ($this->isNewRecord) {
            // it's not allowed to create new base units
            // ( base units has to be defined as base line setup)
            $this->is_base_unit = 0;
        }
        return parent::beforeValidate();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('short_desc, description, unit_type_id, base_unit_factor', 'required'),
            array('unit_type_id, is_base_unit', 'numerical', 'integerOnly' => true),
            array('base_unit_factor', 'numerical'),
            array('is_base_unit', 'safe'),
            array('short_desc', 'length', 'max' => 20),
            array('description', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, short_desc, description, unit_type_id, is_base_unit, base_unit_factor', 'safe', 'on' => 'search'),
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
            'ingredientEntries' => array(self::HAS_MANY, 'IngredientEntry', 'unit_id'),
            'recipes' => array(self::HAS_MANY, 'Recipe', 'unit_id'),
            'unitType' => array(self::BELONGS_TO, 'UnitType', 'unit_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'short_desc' => 'Short Desc',
            'description' => 'Description',
            'unit_type_id' => 'Unit Type',
            'is_base_unit' => 'Is Base Unit',
            'base_unit_factor' => 'Base Unit Factor',
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
        $criteria->compare('short_desc', $this->short_desc, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('unit_type_id', $this->unit_type_id);
        $criteria->compare('is_base_unit', $this->is_base_unit);
        $criteria->compare('base_unit_factor', $this->base_unit_factor);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

    /**
     *
     * Enter description here ...
     * @param unknown_type $unitId
     */
    public function getBaseUnit()
    {
        if ($this->unit_type_id != null)
            $this->mBaseUnit = self::initBaseUnit($this->unit_type_id);

        return $this->mBaseUnit;
    }

    /**
     *
     * Enter description here ...
     * @param unknown_type $unitId
     */
    public function initBaseUnit($unitTypeId)
    {
        $data = self::model()->find("unit_type_id = $unitTypeId AND is_base_unit = 1");

        return $data;
    }

    /**
     * get the array for unit options
     */
    public function getUnitOptions()
    {
        $lUnits = self::model()->findAll();

        $lUnitOptions = array();

        foreach ($lUnits as $i) {
            $lUnitOptions[$i->id] = $i->short_desc;
        }

        return $lUnitOptions;
    }

}