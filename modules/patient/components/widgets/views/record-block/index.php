<?php
/***
 * @var $block_id string
 * @var $title string[]
 * @var $subtitle string[]
 * @var $model \app\modules\patient\models\RecordForm
 * @var $attribute string
 * @var $content string
 * @var $scenario string
 */
?>

<div class="panel panel-default panel-<?= $block_id ?>-items" style="margin-top:20px;">
	<?php
	$form = \app\components\ActiveForm::begin([
		'scenario' => $scenario,
		'id'     => 'medicalRecordForm-'.$block_id,
		'action' => '/subscriber-home/record',
		'options' => ['class' => 'medicalRecordForm'],
		'enableClientValidation' => false,
		'enableAjaxValidation' => false,
		'fieldConfig' => [
			'template' => "\n<div class='form-group'>{label}:{input}</div>",
			'labelOptions' => ['class' => 'control-label'],
		],
	]);
	?>

  <div class="panel-body" style="padding-left:11px;">
    <h3 style="margin-bottom:0; margin-left:2px;" class="js-messager-style" data-messager-style="margin-top:-2px;margin-left:-10px;"><?= $form->field($model, $attribute)->plusMinusCheckbox(['class' => 'collapser', 'data-collapse-target' => '.'.$block_id.'Profile', 'title' => $title]) ?></h3>
    <div class="panel-description">
      <div class="<?= $block_id ?>Profile state state-visible <?= $model->$attribute?"":"hidden" ?>"><?= $subtitle['checked'] ?></div>
      <div class="<?= $block_id ?>Profile state state-invisible <?= $model->$attribute?"hidden":"" ?>"><?= $subtitle['unchecked'] ?></div>
    </div>
    <div id="<?= $block_id ?>" class="<?= $block_id ?>Profile <?= $model->$attribute?"":"hidden" ?>">
      <div id="<?= $block_id ?>Checkboxes" class="col-sm-12 profile-control-wrapper"><?= $content ?></div>
    </div>
  </div>

	<?php \app\components\ActiveForm::end(); ?>
</div>
