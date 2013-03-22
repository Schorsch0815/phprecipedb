<?php
/* @var $this IngredientController */
/* @var $model Ingredient */
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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit_usage'); ?>
		<?php echo $form->textField($model,'unit_usage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cologne_phony_code'); ?>
		<?php echo $form->textField($model,'cologne_phony_code',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'soundex_code'); ?>
		<?php echo $form->textField($model,'soundex_code',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( Yii::t('app_btn','Search') ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->