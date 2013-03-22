<?php
/* @var $this UnitController */
/* @var $model Unit */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'short_desc'); ?>
		<?php echo $form->textField($model,'short_desc',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit_type_id'); ?>
		<?php echo $form->textField($model,'unit_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_base_unit'); ?>
		<?php echo $form->textField($model,'is_base_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'base_unit_factor'); ?>
		<?php echo $form->textField($model,'base_unit_factor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( Yii::t('app_btn','Search') ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->