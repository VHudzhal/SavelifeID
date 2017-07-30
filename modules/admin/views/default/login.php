<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
$url = \Yii::$app->guestSession->set('loginUrl', '/admin');

?>
    <?php $loginForm = new \app\models\LoginForm(); ?>
      <?php $form = \app\components\TimedClientForm::begin([
        'id' => 'signInForm',
        'action' => '/login',
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'fieldConfig' => [
          'template' => "\n<div class='form-group'>{label}:{input}</div>",
          'labelOptions' => ['class' => 'control-label'],
        ],
      ]); ?>
		  <?php $form->registerTries($loginForm); ?>
      <?php if ($loginForm->hasErrors()){ ?>
        <?= \yii\helpers\Html::errorSummary($loginForm, ['class' => 'alert alert-danger', 'header' => '']); ?>
      <?php } ?>
      <?= $form->field($loginForm, 'email')->textInput(['autofocus' => true]) ?>

      <?= $form->field($loginForm, 'password', ['template' => "<div class='form-group'>{label}:<div class='input-group'>{input}<div class='input-group-btn'><button  type='button' class='btn btn-default btn-forgot' tabindex='999'>I forgot</buton></div></div></div>"])->passwordInput() ?>

      <div class="form-group">
        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary col-xs-12', 'name' => 'login-button']) ?>
      </div>
      <?php \app\components\TimedClientForm::end(); ?>
