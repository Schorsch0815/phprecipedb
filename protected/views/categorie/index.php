<?php
/* @var $this CategorieController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Categorie::label(2),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Categorie::label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Categorie::label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Categorie::label(2);?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
