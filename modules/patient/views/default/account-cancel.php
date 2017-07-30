<?php
 /**
  * @var $model \app\modules\patient\models\Patient
  * @var $this \yii\web\View
  */
  \app\assets\AjaxFormAsset::register($this);
  $this->title = 'Account Information';

?>
<div class="panel-body panel-cancel-lost-or-stolen-card">
  <h3>Cancel lost or stolen card</h3>

	<?php
	if (Yii::$app->patient->status == \app\modules\patient\models\Patient::STATUS_ACTIVE) {
		$tokens = [];
		foreach(Yii::$app->patient->model->tokens as $token){
			$tokens[] = $token;
		}

		if ($tokens) {
			foreach($tokens as $token){
				$id = 'token-wrapper-'.$token->association_id;
				?><div id="<?=$id?>">
				<?= $this->render('__account_cancel_lost_card__active', ['model' => $token]); ?>
              </div>
				<?php
			}
		} else {
			echo $this->render('__account_cancel_lost_card__none');
		}
	} else {
		echo $this->render('__account_cancel_lost_card__inactive');
	}
	?>
</div>
