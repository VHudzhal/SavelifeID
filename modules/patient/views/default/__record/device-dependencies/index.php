<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->device_dependencies) { ?>
	  <?= \app\modules\patient\components\widgets\RecordBlock::widget([
  		'scenario' => RecordForm::SCENARIO_DEVICES,
		  'block_id'  => 'devices',
		  'title'     => [
			  'checked'   => 'Click to prevent any Devices from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
			  'unchecked' => 'Click to allow selected Devices to appear on your emergency profile; otherwise none will appear.'
		  ],
		  'subtitle'  => [
			  'checked'   => 'Dependencies will now be displayed on your profile',
			  'unchecked' => 'Dependencies information will not be displayed in your profile.',
		  ],
		  'model'     => $model,
		  'attribute' => 'display_device',
		  'content'   => $this->render('__record_device_dependencies_block', ['item' => $model->device_dependencies, 'class' => 'list-group margin-bottom-0']),
	  ]) ?>
<?php } ?>
