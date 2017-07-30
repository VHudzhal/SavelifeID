<?php
  /**
   *  @var $this \yii\web\View
   *  @var $model \app\modules\patient\models\ChangePasswordForm
   */
\app\assets\AjaxFormAsset::register($this);
?>


<?php
$form = \app\components\ActiveForm::begin([
	'id' => 'forgot-password-change-password-form',
	'scenario' => \app\modules\patient\models\ChangePasswordForm::SCENARIO_FORGOT,
	'options' => [
		'class' => 'kvk-ajax-form',
		'data-target' => '#mainContent',
	],
	'enableClientValidation' => true,
	'enableAjaxValidation' => false,
	'fieldConfig' => [
		'template' => "\n<div class='form-group'>{label}:{input}{error}</div>",
		'labelOptions' => ['class' => 'control-label'],
	],
]);
?>

<?php if ($model->hasErrors()){ ?>
	<?= \yii\helpers\Html::errorSummary($model, ['class' => 'alert alert-danger', 'header' => '']); ?>
<?php } else { ?>

  <p>Passwords need to be at least 8 characters long and contain at least one number.</p>

  <?= $form->field($model, 'password', ['options' => ['class' => 'form-group col-md-3 margin-bottom-0']])->passwordInput(); ?>
  <?= $form->field($model, 'password_repeat', ['options' => ['class' => 'form-group col-md-3 padding-right-0 margin-bottom-0']])->passwordInput(); ?>

  <button type="submit" class="btn btn-default right" style="margin-top:25px">Reset password</button>

  <?php \app\components\ActiveForm::end(); ?>

<?php } ?>