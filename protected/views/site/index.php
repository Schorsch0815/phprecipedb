<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<ul>
    <li><?php echo CHtml::link('Gii', CController::createUrl("gii/") ); ?>
</ul>
<ul>
    <li><?php echo CHtml::link('Units', CController::createUrl("unit/") ); ?>
    <li><?php echo CHtml::link('Ingredients', CController::createUrl("ingredient/") ); ?>
    <li><?php echo CHtml::link('Recipe', CController::createUrl("recipe/") ); ?>
</ul>
<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>