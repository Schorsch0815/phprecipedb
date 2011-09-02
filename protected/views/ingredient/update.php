<?php
$this->breadcrumbs=array(
	'Ingredients'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ingredient', 'url'=>array('index')),
	array('label'=>'Create Ingredient', 'url'=>array('create')),
	array('label'=>'View Ingredient', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ingredient', 'url'=>array('admin')),
);
?>

<h1>Update Ingredient <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>