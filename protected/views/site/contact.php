<?php $this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Contact Us');
$this->breadcrumbs = array(Yii::t('app', 'Contact'),);
?>

<h1><?php echo Yii::t('app', 'Contact Us');?></h1>
<?php if (Yii::app()->user->hasFlash('contact')) : ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>
<?php else : ?>

<p>
<?php echo Yii::t('app', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.');?>
</p>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm'); ?>

	<p class="note"><?php echo Yii::t('app', 'Fields with {asterisk} are required.', array('{asterisk}' => '<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'email'); ?>
		<?php echo $form->textField($model, 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'subject'); ?>
		<?php echo $form
        ->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'body'); ?>
		<?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<?php if (CCaptcha::checkRequirements()) : ?>
	<div class="row">
        <?php echo $form->labelEx($model, 'verifyCode'); ?>
        <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
                array('model'=>$model, 'attribute'=>'verifyCode',
                     'theme'=>'red', 'language'=>Yii::app()->getLanguage(), 
                     'publicKey'=>'6LdqHN4SAAAAADStOSXnMObyqAHNb8S2jJLmclvY')) ?>
		<div class="hint"><?php echo Yii::t('app', 'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.')?></div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app_btn','Submit')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<?php endif; ?>
