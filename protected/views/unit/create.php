<?php
$this->breadcrumbs=array(
	'Units'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Unit', 'url'=>array('index')),
	array('label'=>'Manage Unit', 'url'=>array('admin')),
);
?>

<h1>Create Unit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>