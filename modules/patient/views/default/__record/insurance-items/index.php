<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->insurance_items) { ?>
  <?= \app\modules\patient\components\widgets\RecordBlock::widget([
	'scenario' => RecordForm::SCENARIO_INSURANCE,
    'block_id'  => 'insurance',
    'title'     => [
      'checked'   => 'Click to prevent any Insurance from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
      'unchecked' => 'Click to allow selected Insurance to appear on your emergency profile; otherwise none will appear.'
    ],
    'subtitle'  => [
      'checked'   => 'Insurance can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
      'unchecked' => 'Insurance information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
    ],
    'model'     => $model,
    'attribute' => 'display_insurance',
    'content'   => $this->render('__record_insurance_block', ['items' => $model->insurance_items, 'class' => 'list-group margin-bottom-0']),
  ]) ?>
<?php } ?>
