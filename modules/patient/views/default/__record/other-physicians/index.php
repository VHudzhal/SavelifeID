<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?= \app\modules\patient\components\widgets\RecordBlock::widget([
	'scenario' => RecordForm::SCENARIO_OTHER_PHYSICIANS,
	'block_id'  => 'physicians',
	'title'     => [
		'checked'   => 'Click to prevent any Physicians from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
		'unchecked' => 'Click to allow selected Physicians to appear on your emergency profile; otherwise none will appear.'
	],
	'subtitle'  => [
		'checked'   => 'Physicians can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
		'unchecked' => 'Physicians information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
	],
	'model'     => $model,
	'attribute' => 'display_physicians_contact_info',
	'content'   => $this->render('__record_other_physicians_block', ['items' => $model->other_physicians_items, 'class' => 'list-group margin-bottom-0']),
]) ?>
