<?php
$this->breadcrumbs = array('Ingredients',);

$this->menu = array(
        array('label' => 'Create Ingredient', 'url' => array('create')),
        array('label' => 'Manage Ingredient', 'url' => array('admin')),);
?>

<h1>Ingredients</h1>
<?php /*$this->widget('zii.widgets.CListView', array(
      'dataProvider'=>$dataProvider,
      'itemView'=>'_view',
      )); */

$this
    ->widget(
        'application.extensions.alphapager.ApListView',
        array('dataProvider' => $dataProvider, 'itemView' => '_view',
                'template' => "{alphapager}\n{pager}\n{items}",));
?>
