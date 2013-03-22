<?php
/* @var $this UnitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Unit::label(2),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Unit::label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Unit::label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Unit::label(2);?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
