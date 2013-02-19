<div class="form">
<?php $form = $this
		->beginWidget('CActiveForm',
				array('id' => 'recipe-finish-form',
						'enableAjaxValidation' => false,));
?>

	<p class="note">All data for the recipe are entered. You have now the change
	to review your inputs and save the recipe to the database.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->labelEx($model, 'comment'); ?>
	<?php echo $form
		->textArea($model, 'comment', array('rows' => 15, 'cols' => 60));
	?>

    <div class="row">
		<?php echo $form->labelEx($model, 'attributes'); ?>
        <?php echo $form->error($model, 'attributes'); ?>
        <?php echo $form->listBox($model, 'attributes', Categorie::getCategoriesOptions(), array('multiple'=>'multiple', 'size'=>10)); ?>
    </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Finish'); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
