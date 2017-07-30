<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\patient\models\ChangePasswordForm
   */
?>

<?=  \yii\bootstrap\Alert::widget([
	'options' => [
		'class' => 'alert-success',
	],
	'body' => 'Your password has been changed.',
]) ?>
