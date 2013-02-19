<?php
/* @var $this CategorieController */
/* @var $model Categorie */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Categorie', 'url'=>array('index')),
	array('label'=>'Manage Categorie', 'url'=>array('admin')),
);
?>

<h1>Create Categorie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>