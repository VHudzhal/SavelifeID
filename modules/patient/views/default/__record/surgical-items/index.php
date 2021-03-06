<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->surgical_history_items || $model->surgical_history_text_items ) { ?>
	<?= \app\modules\patient\components\widgets\RecordBlock::widget([
		'scenario' => RecordForm::SCENARIO_SURGICAL_HISTORY,
		'block_id'  => 'surgicalHistory',
		'title'     => [
			'checked'   => 'Click to prevent any Surgical History from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
			'unchecked' => 'Click to allow selected Surgical History to appear on your emergency profile; otherwise none will appear.'
		],
		'subtitle'  => [
			'checked'   => 'Surgical History can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
			'unchecked' => 'Surgical History information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
		],
		'model'     => $model,
		'attribute' => 'display_procedures',
		'content'   =>
			$this->render('__record_surgical_history_text_block', ['items' => $model->surgical_history_text_items, 'class' => 'list-group margin-bottom-0'])
			.
			$this->render('__record_surgical_history_block', ['items' => $model->surgical_history_items, 'class' => 'list-group margin-bottom-0']),
	    'layout'    => \app\modules\patient\components\widgets\RecordBlock::LAYOUT_DEFAULT,
	]) ?>
<?php } ?>
