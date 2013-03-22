<div class="form">

<?php $form=$this->beginWidget('CActiveForm',
        array('id' => 'recipe-finish-form',
						'enableAjaxValidation' => false,)); ?>
	<p class="note">All data for the recipe are entered. You have now the change
	to review your inputs and save the recipe to the database.</p>

	<?php echo $form->errorSummary($model); ?>
	
    <div class="row">
    	<div class="six columns">
        	<?php echo $form->labelEx($model, 'comment'); ?>
        	<?php echo $form
        		->textArea($model, 'comment', array('placeholder' => 'Place your comment here', 'rows' => 15, 'cols' => 60));
        	?>
        </div>
    </div>

    <div class="row">
        <div class="two columns">
		<?php echo $form->labelEx($model, 'courses'); ?>
        <?php echo $form->error($model, 'courses'); ?>
        <?php echo $form->listBox($model, 'courses', Course::getCourseOptions(), array('multiple'=>'multiple', 'size'=>10)); ?>
        </div>
        <div class="two columns">
		<?php echo $form->labelEx($model, 'categories'); ?>
        <?php echo $form->error($model, 'categories'); ?>
        <?php echo $form->listBox($model, 'categories', Categorie::getCategorieOptions(), array('multiple'=>'multiple', 'size'=>10)); ?>
        </div>
        <div class="two columns">
        <?php echo $form->labelEx($model, 'attributes'); ?>
        <?php echo $form->error($model, 'attributes'); ?>
        <?php echo $form->listBox($model, 'attributes', Attribute::getAttributeOptions(), array('multiple'=>'multiple', 'size'=>10)); ?>
        </div>
    </div>

    <div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app_btn','Finish')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
