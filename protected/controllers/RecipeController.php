<?php

class RecipeController
        extends Controller
{

    public function beforeAction($action)
    {
        $config = array();
        echo "<pre>";
//        echo "ReceipeController:\n";
//        var_dump($this);
//        echo "\nAction:\n";
//        var_dump($action);
        echo "\nApp Session\n";
        $session = Yii::app()->getSession();
        echo "\nDump Session\n";
        var_dump( $session );
        echo "</pre>";
        
        switch ($action->id) {
            case 'new':
                if (!isset($session['numIngredientStep']))
                    $session['numIngredientStep'] = 1;
                if (!isset($session['numPreparationStep']))
                    $session['numPreparationStep'] = 1;
                
                $steps = array();
                $steps[] = 'recipeStart';
                
                for ($i = 0; $i < $session['numIngredientStep']; $i++) {
                    $steps[] = 'ingredientStep' . ($i + 1);
                }
                for ($i = 0; $i < $session['numPreparationStep']; $i++) {
                    $steps[] = 'preperationStep' . ($i + 1);
                }
                $steps[] = 'recipeFinish';
                
                $config = array(
                    'steps' => $steps,
                    'events' => array(
                        'onStart' => 'wizardStart',
                        'onProcessStep' => 'recipeProcessStep',
                        'onFinished' => 'wizardFinished',
                        'onInvalidStep' => 'wizardInvalidStep'
                    )
                );
                break;
            default:
//                echo "run into default branch huh...";
                break;
        }
        if (!empty($config)) {
            $config['class'] = 'application.components.WizardBehavior';
            $this->attachBehavior('wizard', $config);
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    // Wizard Behavior Event Handlers
    /**
     * Raised when the wizard starts; before any steps are processed.
     * MUST set $event->handled=true for the wizard to continue.
     * Leaving $event->handled===false causes the onFinished event to be raised.
     * @param WizardEvent The event
     */
    public function wizardStart($event)
    {
        $event->handled = true;
    }

    /**
     * Raised when the wizard detects an invalid step
     * @param WizardEvent The event
     */
    public function wizardInvalidStep($event)
    {
        Yii::app()->getUser()->setFlash('notice', $event->step . ' is not a vaild step in this wizard');
    }

    /**
     * The wizard has finished; use $event->step to find out why.
     * Normally on successful completion ($event->step===true) data would be saved
     * to permanent storage; the demo just displays it
     * @param WizardEvent The event
     */
    public function wizardFinished($event)
    {
        if ($event->step === true)
            $this->render('completed', compact('event'));
        else
            $this->render('finished', compact('event'));

        $event->sender->reset();
        Yii::app()->end();
    }

    public function actionNew($step=null)
    {
        $this->pageTitle = 'Recipe Wizard';
        $this->process($step);
    }

    /**
     * Process steps from the quiz
     * @param WizardEvent The event
     */
    public function recipeProcessStep($event)
    {
        // upper case first letter and trim numbers
        // ok, only trailing numbers should be trimmed
        // So be carful and do not use numbers in model names!!!
        // Only for ingredient and preparation step the steps can have
        // trailing numbers which has to be removed.
        $modelName = trim( ucfirst(str_replace('_', '', $event->step)), "1234567890" );
        $model = new $modelName();
        $model->attributes = $event->data;
        
        if (isset($_POST["$modelName"])) {
  			$model->attributes=$_POST["$modelName"];
            
            if (!empty($_REQUEST['parseButton']))
            {
                if ($model->validateIngredients())
                    $model->isParsed = true;
                
                $event->sender->save($model->attributes);

                print( "New $modelName\n");
                $modelName = strtolower($modelName);
                $this->render('form', compact('modelName', 'event', 'model'));
            }
            elseif (!empty($_REQUEST['newButton']))
            {
                $session = Yii::app()->getSession();

                $event->sender->save($model->attributes);
                $model->isLastStep = false;
                
                $session['numIngredientStep'] += 1;

                $modelName = strtolower($modelName);
                $this->render('form', compact('modelName', 'event', 'model'));
            }
            else
                if ($model->validate()) {
                    $event->sender->save($model->attributes);
                    $event->handled = true;
                }
        }
        else
        {
            print( "New $modelName\n");
            $modelName = strtolower($modelName);
            $this->render('form', compact('modelName', 'event', 'model'));
        }
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}