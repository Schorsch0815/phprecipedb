<?php

class RecipeController
        extends Controller
{

    public function beforeAction($action)
    {
        $config = array();
        switch ($action->id) {
            case 'new':
                $config = array(
                    'steps' => array('recipeStart', 'ingredientStep', 'preperationStep', 'recipeFinish'),
                    'events' => array(
                        'onStart' => 'wizardStart',
                        'onProcessStep' => 'recipeProcessStep',
                        'onFinished' => 'wizardFinished',
                        'onInvalidStep' => 'wizardInvalidStep'
                    ),
                    'menuLastItem' => 'Register'
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
        $modelName = ucfirst(str_replace('_', '', $event->step));
        $model = new $modelName();
        $form = $model->getForm();
        if ($form->submitted() && $form->validate()) {
            $event->sender->save($model->attributes);
            $event->handled = true;
        }
        else
            $this->render('form', compact('event', 'form'));
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