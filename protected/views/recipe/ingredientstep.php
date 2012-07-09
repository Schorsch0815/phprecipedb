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

    <?php if(!$model->isParsed): ?>
        <div class="row">
            <?php echo $form->labelEx($model,'ingredients'); ?>
            <?php echo $form->textArea($model,'ingredients',array('rows'=>15,'cols'=>60)); ?>
            <?php echo $form->error($model,'ingredients'); ?>
        </div>
    <?php else: ?>
        <?php for ($i = 0; $i < sizeof($model->parsedIngredients); ++$i): ?>
            <?php echo $form->textField($model,'ingredientsArray['.$i.'][0]',array('size'=>5,'maxlength'=>5, 'value'=>$model->parsedIngredients[$i][0])); ?>
            <?php echo $form->dropDownList($model,'ingredientsArray['.$i.'][1]', $model->parsedIngredients[$i][1] ); ?>
            <?php echo $form->dropDownList($model,'ingredientsArray['.$i.'][2]', $model->parsedIngredients[$i][2] ); ?>
            <br>
        <?php endfor; ?>
    <?php endif; ?>
   
	<div class="row buttons">
		<?php echo CHtml::submitButton('Parse ingredients', ($model->isParsed) ? array("disabled"=>"disabled") : array( "name"=>"parseButton" ) );  ?> 
		<?php echo CHtml::submitButton('New ingredient step', ($model->isParsed && $model->isLastStep) ? array( "name"=>"newIngredientButton" ) : array( "disabled"=>"disabled"));  ?> 
        <?php echo CHtml::submitButton('Next', ($model->isParsed) ? array("name"=>"nextButton") : array("disabled"=>"disabled")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
