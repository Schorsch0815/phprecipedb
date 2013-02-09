<?php

class RecipeController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('userGroupsAccessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
                array('allow',
                        // allow all users to perform 'index' and 'view' actions
                        'actions' => array('index'),
                        'users' => array('@'),),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions' => array('new'),
                        'groups' => array('admin', 'editor', 'author'),),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'actions' => array('admin', 'delete'),
                        'groups' => array('admin', 'editor'),),
                array('deny', // deny all users
                'users' => array('*'),),);
    }

    public function beforeAction($action)
    {
        $config = array();
        $session = Yii::app()->getSession();

        switch ($action->id) {
        case 'new':
            if (!isset($session['numIngredientStep']))
                $session['numIngredientStep'] = 1;
            if (!isset($session['numPreparationStep']))
                $session['numPreparationStep'] = 1;

            $config = $this->createMenuConfig($session);
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
        Yii::app()->getUser()
            ->setFlash(
                'notice',
                $event->step . ' is not a vaild step in this wizard');
    }

    /**
     * The wizard has finished; use $event->step to find out why.
     * Normally on successful completion ($event->step===true) data would be saved
     * to permanent storage; the demo just displays it
     * @param WizardEvent The event
     */
    public function wizardFinished($event)
    {
        if ($event->step === true) {
            $this->storeData2DB($event);
            $this->render('completed', compact('event'));
        } else {
            $this->render('finished', compact('event'));
        }

        $event->sender->reset();
        Yii::app()->end();
    }

    public function actionNew($step = null)
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
        $modelName = trim(
            ucfirst(str_replace('_', '', $event->step)),
            "1234567890");
        $model = new $modelName();
        $model->attributes = $event->data;

        if (isset($_POST["$modelName"])) {
            $model->attributes = $_POST["$modelName"];

            if (!empty($_REQUEST['parseButton'])) {
                if ($model->validateIngredients())
                    $model->isParsed = true;

                $event->sender->save($model->attributes);

                $modelName = strtolower($modelName);
                $this->render('form', compact('modelName', 'event', 'model'));
            } elseif (!empty($_REQUEST['unparseButton'])) {
                $model->unParseIngredients();
                $model->isParsed = false;

                $event->sender->save($model->attributes);

                $modelName = strtolower($modelName);
                $this->render('form', compact('modelName', 'event', 'model'));
            } elseif (!empty($_REQUEST['newIngredientButton'])) {
                $session = Yii::app()->getSession();

                $event->sender->save($model->attributes);
                $model->isLastStep = false;

                $session['numIngredientStep'] += 1;

                $event->sender->continueWithNext();
            } elseif (!empty($_REQUEST['newPreparationButton'])) {
                $session = Yii::app()->getSession();

                $event->sender->save($model->attributes);
                $model->isLastStep = false;

                $session['numPreparationStep'] += 1;

                $event->sender->continueWithNext();
            } else if ($model->validate()) {

                $event->sender->save($model->attributes);
                $event->handled = true;
            }
        } else {
            $modelName = strtolower($modelName);
            $this->render('form', compact('modelName', 'event', 'model'));
        }
    }

    protected function createMenuConfig($session)
    {
        $steps = array();
        $steps[] = 'recipeStart';

        for ($i = 0; $i < $session['numIngredientStep']; $i++) {
            $steps[] = 'ingredientStep' . ($i + 1);
        }
        for ($i = 0; $i < $session['numPreparationStep']; $i++) {
            $steps[] = 'preparationStep' . ($i + 1);
        }
        $steps[] = 'recipeFinish';

        $config = array('steps' => $steps,
                'events' => array('onStart' => 'wizardStart',
                        'onProcessStep' => 'recipeProcessStep',
                        'onFinished' => 'wizardFinished',
                        'onInvalidStep' => 'wizardInvalidStep'));
        return $config;
    }

    protected function storeData2DB($event)
    {
        $recipe = new Recipe();

        foreach ($event->getData() as $stepName => $value) {
            //           FB::log(var_export($stepName));
            //           FB::log(var_export($value));

            if ($stepName == 'recipeStart') {
                // create recipe and set attributes
                $recipe->name = $value['name'];
                $recipe->description = $value['description'];
                $recipe->quantity = $value['quantity'];
                $recipe->unit_id = $value['unit_id'];
                $isSaved = $recipe->save();
            } elseif (strncmp($stepName, 'ingredientStep', 14) == 0) {
                $ingredientSection = new IngredientSection();
                $ingredientSection->recipe_id = $recipe->id;
                $ingredientSection->name = $value['name'];
                $ingredientSection->seq_no = $value['seqNo'];
                $isSaved = $ingredientSection->save();

                for ($i=0; $i < sizeof($value['ingredientsArray']); ++$i ) {
                    $ingredient = $value['ingredientsArray'][$i];
                    if (0 == $ingredient[2]) {
                        // ok this is a new unknown ingredient, let's store it
                        $newIngredient = new Ingredient();
                        $newIngredient->name = $value['parsedIngredients'][$i][2][$ingredient[2]];
                        $newIngredient->cologne_phony_code = Utilities::germanphonetic($newIngredient->name);
                        $newIngredient->soundex_code = soundex($newIngredient->name);
                        $newIngredient->unit_usage = Unit::calcUsageBitMask($ingredient[1]);
                        $isSaved = $newIngredient->save();
                        $ingredient[2] = $newIngredient->id;
                    }
                    $ingredientEntry = new IngredientEntry();
                    $ingredientEntry->ingredient_section_id = $ingredientSection
                        ->id;
                    $ingredientEntry->ingredient_section_recipe_id = $ingredientSection
                        ->recipe_id;
                    $ingredientEntry->quantity = $ingredient[0];
                    $ingredientEntry->unit_id = $ingredient[1];
                    $ingredientEntry->ingredient_id = $ingredient[2];
                    $isSaved = $ingredientEntry->save();

                    $entries = $ingredientSection->ingredientEntries;
                    $entries[] = $ingredientEntry;
                    $ingredientSection->ingredientEntries = $entries;
                }

                $isSaved = $ingredientSection->save();

                $inSects = $recipe->ingredientSections;
                $inSects[] = $ingredientSection;
                $recipe->ingredientSections = $inSects;
            } elseif (strncmp($stepName, 'preparationStep', 15) == 0) {
                $preparationSection = new PreparationSection();

                $preparationSection->recipe_id = $recipe->id;
                $preparationSection->name = $value['name'];
                $preparationSection->seq_no = $value['seqNo'];
                $preparationSection->description = $value['description'];

                $isSaved = $preparationSection->save();

                $prepSects = $recipe->preparationSections;
                $prepSects[] = $preparationSection;
                $recipe->preparationSections = $prepSects;
            }
        }
        $isSaved = $recipe->save();
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
