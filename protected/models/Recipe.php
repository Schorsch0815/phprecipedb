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
    public static function model($className = __CLASS__)
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
        return array(array('name', 'required'),
                array('description, quantity, unit_id', 'safe'),
                array('unit_id', 'numerical', 'integerOnly' => true),
                array('quantity', 'numerical'),
                array('name', 'length', 'max' => 64),
                array('description', 'length', 'max' => 256),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id, name, description, quantity, unit_id', 'safe',
                        'on' => 'search'),);
    }

    /**
     * 
     * @return multitype:multitype:string
     */
    public function behaviors()
    {
        return array(
                'activerecord-relation'=>array(
                        'class'=>'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',)
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
                'ingredientSections' => array(self::HAS_MANY,
                        'IngredientSection', 'recipe_id'),
                'preparationSections' => array(self::HAS_MANY,
                        'PreparationSection', 'recipe_id'),
                'unit' => array(self::BELONGS_TO, 'Unit', 'unit_id'),
	            'categories' => array(self::MANY_MANY, 'Categorie', 'tbl_recipe_has_categorie(recipe_id, categorie_id)'),
	            'courses' => array(self::MANY_MANY, 'Course', 'tbl_recipe_is_course(recipe_id, course_id)'),
                'attributes' => array(self::MANY_MANY, 'Attribute', 'tbl_recipe_has_attribute(recipe_id, attribute_id)'),
        );
    }

    /**
     * @return array of categories (id => 'description') used for html list boxes
     */
    public function getCategories()
    {
    	return CHtml::listData(Categorie::model()->findAll(), 'categorie_id', 'description');
    }
    
    /**
     * @ return array of assigned categories
     */
    public function getAssignedCategories()
    {
    	return $this->categories;
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array('id' => 'ID', 'name' => 'Name',
                'description' => 'Description', 'quantity' => 'Quantity',
                'unit_id' => 'Unit',);
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
        $criteria->compare('description', $this->description, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('unit_id', $this->unit_id);

        return new CActiveDataProvider(get_class($this),
            array('criteria' => $criteria,));
    }
}

/*
 * 
 * Hi everyone,

I have 2 Models: Users and AdPositions and a linking table user_has_ad_position. With this I can check where each user may put his ads.
Now the problem is with the assignment of these permissions. When I update a user I want to see a list with his current positions (these should be selected) PLUS all the other ones that I might assign (unselected).

So basically this is what I have:
/models/User.php

    public function relations() {
        return array(
            'positions' => array(self::MANY_MANY, 'AdPosition', 'user_has_ad_position(userid, ad_positionid)'),
        );

    public function getAdpositions() {
        // this gives all possible ad_positions
        $listData = CHtml::listData(AdPosition::model()->findAll(), 'ad_positionid', 'label');


        return $listData;
    }



And in views/user/_form.php:

...
<?php echo CHtml::activeListBox($model, 'adpositions',$model->getAdpositions()); ?>
...


There might also be a problem with the field 'adpositions'. Because in the User model I obviously don't have any attribute for AdPositions other than my relation.

Thanks a lot for your help



Solution (thanks to yjeroen in IRC):
[code]
public function getAdpositions() {
// this gives all possible ad_positions

return CHtml::listData(AdPosition::model()->findAll(), 'ad_positionid', 'label');
}

public function getAssignedAdpositions() {
return $this->positions;
}
[/php]

and in the view:

<?php echo CHtml::activeListBox($model, 'assignedAdpositions',$model->getAdpositions(), array('multiple'=>'multiple')); ?>


Also assignedAdpositions isn't really an attribute it behaves like one thanks to the magic __get() method. 

*/
