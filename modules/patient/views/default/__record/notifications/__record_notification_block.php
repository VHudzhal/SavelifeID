<?php
/**
 * @var $model \app\modules\patient\models\RecordForm
 */

  use app\modules\patient\models\RecordForm;
?>

	<div class="col-sm-6">
		<h4>When should we notify you?</h4>
		<ul class="list-group">
      <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
				<?= \yii\bootstrap\Html::label('Whenever my card is scanned', 'record-form-notification_scanned')?>
				<div class="form-group pull-right">
					<?= \yii\bootstrap\Html::hiddenInput('RecordForm[notification_scanned]', 0)?>
					<?= \yii\bootstrap\Html::checkbox('RecordForm[notification_scanned]', $model->notification_scanned, ['id'=> 'record-form-notification_scanned'])?>
					<?= \yii\bootstrap\Html::label('', 'record-form-notification_scanned')?>
				</div>
			</li>
      <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
				<?= \yii\bootstrap\Html::label('Whenever my medical info is changed', 'record-form-notification_updates')?>
				<div class="form-group pull-right">
					<?= \yii\bootstrap\Html::hiddenInput('RecordForm[notification_updates]', 0)?>
					<?= \yii\bootstrap\Html::checkbox('RecordForm[notification_updates]', $model->notification_updates, ['id'=> 'record-form-notification_updates'])?>
					<?= \yii\bootstrap\Html::label('', 'record-form-notification_updates')?>
				</div>
			</li>
		</ul>
	</div>
	<div class="col-sm-6">
		<h4>How should we notify you?</h4>
		<ul class="list-group">
			<li class="list-group-item">
				<?= \yii\bootstrap\Html::label('By e-mail to '. Yii::$app->patient->email, 'record-form-notify_email')?>
				<div class="form-group pull-right">
					<?= \yii\bootstrap\Html::hiddenInput('RecordForm[notify_email]', 0)?>
					<?= \yii\bootstrap\Html::radio('RecordForm[notify_way]', $model->notify_way == RecordForm::NOTIFY_WAY_EMAIL , ['id'=> 'record-form-notify_email', 'value' => RecordForm::NOTIFY_WAY_EMAIL])?>
					<?= \yii\bootstrap\Html::label('', 'record-form-notify_email')?>
				</div>
				<?php if (Yii::$app->patient->cell_phone) { ?>
      <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
				<?= \yii\bootstrap\Html::label('By text to '. Yii::$app->patient->cell_phone, 'record-form-notify_phone')?>
				<div class="form-group pull-right">
					<?= \yii\bootstrap\Html::hiddenInput('RecordForm[notify_phone]', 0)?>
					<?= \yii\bootstrap\Html::radio('RecordForm[notify_way]', $model->notify_way == RecordForm::NOTIFY_WAY_PHONE, ['id'=> 'record-form-notify_phone', 'value' => RecordForm::NOTIFY_WAY_PHONE])?>
					<?= \yii\bootstrap\Html::label('', 'record-form-notify_phone')?>
				</div>
			</li>
      <li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
				<?= \yii\bootstrap\Html::label('Both ways', 'record-form-notify_both')?>
				<div class="form-group pull-right">
					<?= \yii\bootstrap\Html::hiddenInput('RecordForm[notify_both]', 0)?>
					<?= \yii\bootstrap\Html::radio('RecordForm[notify_way]', $model->notify_way == RecordForm::NOTIFY_WAY_BOTH, ['id'=> 'record-form-notify_both', 'value' => RecordForm::NOTIFY_WAY_BOTH])?>
					<?= \yii\bootstrap\Html::label('', 'record-form-notify_both')?>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
