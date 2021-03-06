<div class="form">
<?php $form = $this
    ->beginWidget(
        'CActiveForm',
        array('id' => 'preparation-step-form', 'enableAjaxValidation' => false,));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form
    ->textField($model, 'name', array('size' => 32, 'maxlength' => 64)); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

 	<div class="row">
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php echo $form
    ->textArea($model, 'description', array('placeholder' => 'Description of preparation', 'rows' => 15, 'cols' => 60)); ?>
		<?php echo $form->error($model, 'description'); ?>
	</div>

	<div class="row buttons">
	    <?php echo CHtml::submitButton(
    Yii::t('app_btn','New preparation step'),
    ($model->isLastStep) ? array("name" => "newPreparationButton")
        : array("disabled" => "disabled")); ?>
		<?php echo CHtml::submitButton(Yii::t('app_btn','Next')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
