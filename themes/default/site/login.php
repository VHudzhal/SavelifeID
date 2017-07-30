<?php

/* @var $this yii\web\View */
/* @var $form \app\components\TimedClientForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use app\components\TimedClientForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
  <h1 class="modal-title" id="signinTitle">Sign In</h1>
	<?php $form = TimedClientForm::begin([
		'id' => 'signInForm',
		'action' => '/login',
		'enableClientValidation' => true,
		'enableAjaxValidation' => false,
		'fieldConfig' => [
			'template' => "\n<div class='form-group'>{label}:{input}</div>",
			'labelOptions' => ['class' => 'control-label'],
		],
	]); ?>
      <?php $form->registerTries($model); ?>
        <?php if ($model->hasErrors()){ ?>
            <?= \yii\helpers\Html::errorSummary($model, ['class' => 'alert alert-danger', 'header' => '']); ?>
        <?php } ?>
        <?php
          if (Yii::$app->session->hasFlash('loginMessage')) {
            echo "<div class='alert alert-danger'>". implode('', \Yii::$app->session->getFlash('loginMessage')). "</div>";
          }
        ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

      	<?= $form->field($model, 'password', ['template' => "<div class='form-group'>{label}:<div class='input-group'>{input}<div class='input-group-btn'><button  type='button' class='btn btn-default btn-forgot' tabindex='999'>I forgot</buton></div></div></div>"])->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
    <?php TimedClientForm::end(); ?>
  <!-- Forgot password -->
  <div class="forgotPassMessage">If this email address is associated with an account, instructions for resetting your password have just been emailed to you.</div>
</div>
