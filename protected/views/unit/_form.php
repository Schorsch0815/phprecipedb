<?php
/* @var $this UnitController */
/* @var $model Unit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'unit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with {asterisk} are required.', array('{asterisk}' => '<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'short_desc'); ?>
		<?php echo $form->textField($model,'short_desc',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'short_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_type_id'); ?>
		<?php echo $form->textField($model,'unit_type_id'); ?>
		<?php echo $form->error($model,'unit_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_base_unit'); ?>
		<?php echo $form->textField($model,'is_base_unit'); ?>
		<?php echo $form->error($model,'is_base_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'base_unit_factor'); ?>
		<?php echo $form->textField($model,'base_unit_factor'); ?>
		<?php echo $form->error($model,'base_unit_factor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app_btn', 'Create') : Yii::t('app_btn', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->