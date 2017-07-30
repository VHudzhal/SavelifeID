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
	if (\Yii::$app->session->hasFlash('support-confirmation')) {
		echo \yii\bootstrap\Alert::widget([
			'options' => [
				'class' => 'alert-success',
			],
			'body' => \Yii::$app->session->getFlash('support-confirmation'),
		]);
	} else {

		if ($model->support_request == 0){
			?>
          <div class="alert alert-info">
            Please confirm the support session
            <a href="/subscriber-home/confirm-request" class="btn btn-default">Confirm support session</a>
          </div>
			<?php
		} else {
			?>
          <div class="alert alert-info">No support requests.</div>
			<?php
		}

	}

	?>
</div>
