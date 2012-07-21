<?php
echo $event->sender->menu->run();
echo '<div>Step ' . $event->sender->currentStep . ' of '
    . $event->sender->stepCount;
echo '<h3>' . $event->sender->getStepLabel($event->step) . '</h3>';

echo $this->renderPartial($modelName, array('model' => $model));

/*echo '<pre>The Event<pre>';
var_dump( $event );
echo "\nSession:\n";
var_dump($_SESSION);
echo '</pre>';
 */
?>

