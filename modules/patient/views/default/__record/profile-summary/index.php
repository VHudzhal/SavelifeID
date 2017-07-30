<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
  use app\modules\patient\models\RecordForm;
  use app\components\Helper;
?>
<?= \app\modules\patient\components\widgets\RecordBlock::widget([
	'scenario' => RecordForm::SCENARIO_EMERGENCY_PROFILE,
	'block_id'  => 'emergency',
	'title'     => [
		'checked'   => 'Click to prevent any Profile Summary from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
		'unchecked' => 'Click to allow selected Profile Summary to appear on your emergency profile; otherwise none will appear.'
	],
	'subtitle'  => [
		'checked'   => 'Profile Summary can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
		'unchecked' => 'Profile Summary information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
	],
	'model'     => $model,
	'attribute' => 'display_emergency_profile_summary',
	'content'   => $this->render('__record_emergency_wrapper', ['model' => $model]),
]) ?>
