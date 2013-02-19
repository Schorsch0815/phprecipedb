<?php
/* @var $this CategorieController */
/* @var $model Categorie */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Categorie', 'url'=>array('index')),
	array('label'=>'Create Categorie', 'url'=>array('create')),
	array('label'=>'Update Categorie', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Categorie', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Categorie', 'url'=>array('admin')),
);
?>

<h1>View Categorie #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
	),
)); ?>
