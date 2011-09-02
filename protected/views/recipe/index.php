<?php
$this->breadcrumbs=array(
	'Recipe',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
<a href="<?php echo CController::createUrl("recipe/new") ?>">New Recipe Wizard&nbsp;&raquo;</a><p>Enter a new recipe .</p><p>You can return to previous steps either using the "Previous" button or the menu; note that $autoAdvance===TRUE, so if you go back two steps the "Next" button goes to the first uncompleted step.</p>
