<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->emr_emergency_summary) { ?>
	  <?= \app\modules\patient\components\widgets\RecordBlock::widget([
  		'scenario' => RecordForm::SCENARIO_EMR_SUMMARY,
		  'block_id'  => 'emr-summary',
		  'title'     => [
			  'checked'   => 'Click to prevent any EMR Emergency Summary from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
			  'unchecked' => 'Click to allow selected EMR Emergency Summary to appear on your emergency profile; otherwise none will appear.'
		  ],
		  'subtitle'  => [
			  'checked'   => 'EMR Emergency Summary will now be displayed on your profile',
			  'unchecked' => 'EMR Emergency Summary information will not be displayed in your profile.',
		  ],
		  'model'     => $model,
		  'attribute' => 'display_emr_emergency_summary',
		  'content'   => $this->render('__record_emr_summary_block', ['item' => $model->emr_emergency_summary, 'class' => 'list-group margin-bottom-0']),
	  ]) ?>
<?php } ?>
