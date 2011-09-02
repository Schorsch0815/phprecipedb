<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingredient-step-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

 	<div class="row">
		<?php echo $form->labelEx($model,'ingredients'); ?>
		<?php echo $form->textArea($model,'ingredients',array('rows'=>15,'cols'=>60)); ?>
		<?php echo $form->error($model,'ingredients'); ?>
	</div>

   
	<div class="row buttons">
		<?php echo CHtml::submitButton('New ingredient step'); ?> 
        <?php echo CHtml::submitButton('Next'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
