<?php
/***
 * @var $block_id string
 * @var $title string[]
 * @var $subtitle string[]
 * @var $model \app\modules\patient\models\RecordForm
 * @var $attribute string
 * @var $content string
 * @var $scenario string
 * @var $label string
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
    <h3><div class="checkbox-big no-js no-pointer"><?= $label ?></div></h3>
    <div id="<?= $block_id ?>" class="<?= $block_id ?>Profile">
      <div id="<?= $block_id ?>Checkboxes" class="col-sm-12 profile-control-wrapper"><?= $content ?></div>
    </div>
  </div>

	<?php \app\components\ActiveForm::end(); ?>
</div>
