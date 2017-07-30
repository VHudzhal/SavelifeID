<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
 use app\modules\patient\models\RecordForm;
?>

<?php if ($model->conditions_items) { ?>
  <?= \app\modules\patient\components\widgets\RecordBlock::widget([
    'scenario' => RecordForm::SCENARIO_CONDITIONS_PROFILE,
    'block_id'  => 'conditions',
    'title'     => [
      'checked'   => 'Click to prevent any Medical Conditions from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
      'unchecked' => 'Click to allow selected Medical Conditions to appear on your emergency profile; otherwise none will appear.'
    ],
    'subtitle'  => [
      'checked'   => 'Medical Conditions can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
      'unchecked' => 'Medical Conditions information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
    ],
    'model'     => $model,
    'attribute' => 'display_conditions',
    'content'   => $this->render('__record_conditions_block', ['items' => $model->conditions_items, 'class' => 'list-group margin-bottom-0']),
  ]) ?>
<?php } ?>

