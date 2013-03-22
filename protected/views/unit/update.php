<?php
/* @var $this UnitController */
/* @var $model Unit */

$this->breadcrumbs=array(
	$model->label(2)=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View') . ' ' . $model->label(), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update') .' '. $model->label() . ' ' .$model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>