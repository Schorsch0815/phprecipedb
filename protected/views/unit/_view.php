<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_desc')); ?>:</b>
	<?php echo CHtml::encode($data->short_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->unit_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_base_unit')); ?>:</b>
	<?php echo CHtml::encode($data->is_base_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('base_unit_factor')); ?>:</b>
	<?php echo CHtml::encode($data->base_unit_factor); ?>
	<br />


</div>