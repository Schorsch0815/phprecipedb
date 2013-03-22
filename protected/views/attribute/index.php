<?php
/* @var $this AttributeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Attribute::label(2),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Attribute::label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Attribute::label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Attribute::label(2);?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
