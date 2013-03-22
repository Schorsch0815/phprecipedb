<?php
/* @var $this IngredientController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Ingredient::label(2),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Ingredient::label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Ingredient::label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Ingredient::label(2);?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
