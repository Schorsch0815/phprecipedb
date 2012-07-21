<?php
$this->breadcrumbs = array('Units' => array('index'), $model->id,);

$this->menu = array(array('label' => 'List Unit', 'url' => array('index')),
        array('label' => 'Create Unit', 'url' => array('create')),
        array('label' => 'Update Unit', 'url' => array('update',
                'id' => $model->id)),
        array('label' => 'Delete Unit', 'url' => '#',
                'linkOptions' => array(
                        'submit' => array('delete', 'id' => $model->id),
                        'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage Unit', 'url' => array('admin')),);
?>

<h1>View Unit #<?php echo $model->id; ?></h1>
<?php $this
    ->widget(
        'zii.widgets.CDetailView',
        array('data' => $model,
                'attributes' => array('id', 'short_desc', 'description',
                        'unit_type_id', 'is_base_unit', 'base_unit_factor',),));
?>
