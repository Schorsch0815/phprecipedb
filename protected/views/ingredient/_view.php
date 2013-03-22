<?php
/* @var $this IngredientController */
/* @var $data Ingredient */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_usage')); ?>:</b>
	<?php echo CHtml::encode($data->unit_usage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cologne_phony_code')); ?>:</b>
	<?php echo CHtml::encode($data->cologne_phony_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('soundex_code')); ?>:</b>
	<?php echo CHtml::encode($data->soundex_code); ?>
	<br />


</div>