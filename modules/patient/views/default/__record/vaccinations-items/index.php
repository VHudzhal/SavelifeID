<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->vaccinations_items) { ?>
	<?= \app\modules\patient\components\widgets\RecordBlock::widget([
		'scenario' => RecordForm::SCENARIO_VACCINATIONS,
		'block_id'  => 'vaccinations',
		'title'     => [
			'checked'   => 'Click to prevent any Vaccinations from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
			'unchecked' => 'Click to allow selected Vaccinations to appear on your emergency profile; otherwise none will appear.'
		],
		'subtitle'  => [
			'checked'   => 'Vaccinations can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
			'unchecked' => 'Vaccinations information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
		],
		'model'     => $model,
		'attribute' => 'display_vaccinations',
		'content'   => $this->render('__record_vaccinations_block', ['items' => $model->vaccinations_items, 'class' => 'list-group margin-bottom-0']),
	]) ?>
<?php } ?>
