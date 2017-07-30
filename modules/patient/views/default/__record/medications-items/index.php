<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->medications_items) { ?>
	<?= \app\modules\patient\components\widgets\RecordBlock::widget([
		'scenario' => RecordForm::SCENARIO_MEDICATIONS,
		'block_id'  => 'medications',
		'title'     => [
			'checked'   => 'Click to prevent any Medications from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
			'unchecked' => 'Click to allow selected Medications to appear on your emergency profile; otherwise none will appear.'
		],
		'subtitle'  => [
			'checked'   => 'Medications can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
			'unchecked' => 'Medications information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
		],
		'model'     => $model,
		'attribute' => 'display_medications',
		'content'   => $this->render('__record_medications_block', ['items' => $model->medications_items, 'class' => 'list-group margin-bottom-0']),
	]) ?>
<?php } ?>
