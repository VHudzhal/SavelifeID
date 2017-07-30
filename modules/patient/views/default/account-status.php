<?php
 /**
  * @var $model \app\modules\patient\models\Patient
  * @var $this \yii\web\View
  */
  \app\assets\AjaxFormAsset::register($this);
  $this->title = 'Account Information';

?>

<div class="panel-body">
	<?php

	switch (Yii::$app->patient->status){
		case \app\modules\patient\models\Patient::STATUS_ACTIVE:
			echo $this->render('__account_subscription_status/active');
			break;
		case \app\modules\patient\models\Patient::STATUS_PAUSED:
			echo $this->render('__account_subscription_status/paused');
			break;
		case \app\modules\patient\models\Patient::STATUS_CANCEL:
			echo $this->render('__account_subscription_status/cancel');
			break;
		default:
			Yii::error("Incorrect patient account status: ".Yii::$app->patient->status." for internal_id ".Yii::$app->patient->internal_id);
			echo $this->render('__account_subscription_status/paused');
	}
	?>
</div>
