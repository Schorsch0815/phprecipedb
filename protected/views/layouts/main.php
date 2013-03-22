<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request
    ->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request
    ->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request
    ->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request
    ->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request
    ->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
        <?php $this->widget('ext.LanguagePicker.ELangPick', array('pickerType' => 'dropdown')); ?>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this
    ->widget(
        'zii.widgets.CMenu',
        array(
                'items' => array(
                        array('label' => Yii::t('app','Home'), 'url' => array('/site/index')),
                        array('label' => Yii::t('app','About'),
                                'url' => array('/site/page', 'view' => 'about')),
                        array('label' => Yii::t('app','Contact'), 'url' => array(
                                '/site/contact')),
                        array('label' => Yii::t('app','Admin'), 'url' => array('/userGroups/admin'),
                                'visible' => (Yii::app()->user->getLevel() >= 99)),
                        array('label' => Yii::t('app','Login'), 'url' => array('/userGroups/user/login'),
                                'visible' => Yii::app()->user->isGuest),
                        array('label' => Yii::t('app','Logout' ) .' (' . Yii::app()->user->name
                                    . ')', 'url' => array('/userGroups/user/logout'),
                                'visible' => !Yii::app()->user->isGuest)),));
        ?>
	</div><!-- mainmenu -->

	<?php $this
    ->widget(
        'zii.widgets.CBreadcrumbs',
        array('links' => $this->breadcrumbs,));
    ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Jochen Schales.<br/>
		<?php echo Yii::t('app', 'All Rights Reserved.');?><br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
