<?php
 /**
  * @var $model \app\modules\patient\models\Patient
  * @var $this \yii\web\View
  * @var $changePasswordModel \app\modules\patient\models\ChangePasswordForm
  */
  \app\assets\AjaxFormAsset::register($this);
  $this->title = 'Account Information';

?>

<div class="panel-body">
  <h3 class="pointer" data-toggle="collapse" data-target="#chMyPass">Change my password</h3>
  <div id="chMyPass" class="panel-change-password">
    <?= $this->render('__change_password_form', ['model' => $changePasswordModel]) ?>
  </div>
</div>
