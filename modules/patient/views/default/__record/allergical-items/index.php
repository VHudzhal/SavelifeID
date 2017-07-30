<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<?php if ($model->allergies_items) { ?>
	  <?= \app\modules\patient\components\widgets\RecordBlock::widget([
  		'scenario' => RecordForm::SCENARIO_ALLERGY_PROFILE,
		  'block_id'  => 'allergy',
		  'title'     => [
			  'checked'   => 'Click to prevent any Allergies from appearing on your emergency profile; otherwise, selected Hospitals will appear.',
			  'unchecked' => 'Click to allow selected Allergies to appear on your emergency profile; otherwise none will appear.'
		  ],
		  'subtitle'  => [
			  'checked'   => 'Known Allergies can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball',
			  'unchecked' => 'Known Allergies information will not be displayed in your emergency profile until you click the section\'s eyeball to enable it.',
		  ],
		  'model'     => $model,
		  'attribute' => 'display_allergies',
		  'content'   => $this->render('__record_allergy_block', ['items' => $model->allergies_items, 'class' => 'list-group margin-bottom-0']),
	  ]) ?>
<?php } ?>
