<?php
/* @var $this CategorieController */
/* @var $model Categorie */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categorie', 'url'=>array('index')),
	array('label'=>'Create Categorie', 'url'=>array('create')),
	array('label'=>'View Categorie', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Categorie', 'url'=>array('admin')),
);
?>

<h1>Update Categorie <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>