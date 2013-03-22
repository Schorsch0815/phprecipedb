<?php
/* @var $this IngredientController */
/* @var $model Ingredient */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingredient-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with {asterisk} are required.', array('{asterisk}' => '<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unit_usage'); ?>
		<?php echo $form->textField($model,'unit_usage'); ?>
		<?php echo $form->error($model,'unit_usage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cologne_phony_code'); ?>
		<?php echo $form->textField($model,'cologne_phony_code',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'cologne_phony_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'soundex_code'); ?>
		<?php echo $form->textField($model,'soundex_code',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'soundex_code'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app_btn', 'Create') : Yii::t('app_btn', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->