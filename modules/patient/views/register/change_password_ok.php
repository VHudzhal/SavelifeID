<?php
  use app\components\ActiveForm;

  $model = new \app\models\LoginForm();
?>
<div class='alert alert-success'>
  <h2>Your password has been changed successfully!</h2>
  <p>Now you can sign in with your email and new password.</p>
</div>

<div class="site-login">

  <h1 class="modal-title" id="signinTitle">Sign In</h1>

  <?php $form = \app\components\TimedClientForm::begin([
    'id' => 'signInForm',
    'action' => '/login',
    'enableClientValidation' => false,
    'enableAjaxValidation' => false,
    'fieldConfig' => [
      'template' => "\n<div class='form-group'>{label}:{input}</div>",
      'labelOptions' => ['class' => 'control-label'],
    ],
  ]); ?>

  <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

  <?= $form->field($model, 'password', ['template' => "<div class='form-group'>{label}:<div class='input-group'>{input}<div class='input-group-btn'><button  type='button' class='btn btn-default btn-forgot' tabindex='999'>I forgot</buton></div></div></div>"])->passwordInput() ?>

  <div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
      <?= \yii\helpers\Html::submitButton('Sign In', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
  </div>
  <?php \app\components\TimedClientForm::end(); ?>
</div>