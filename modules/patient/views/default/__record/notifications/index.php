<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?= \app\modules\patient\components\widgets\RecordBlock::widget([
	'scenario' => RecordForm::SCENARIO_NOTIFICATIONS,
	'block_id'  => 'notifications',
	'model'     => $model,
	'content'   => $this->render('__record_notification_block', ['model' => $model]),
  'layout'    => \app\modules\patient\components\widgets\RecordBlock::LAYOUT_NO_CONTROL,
  'label'     => 'Notifications'
]) ?>
