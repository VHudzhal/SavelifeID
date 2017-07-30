<?php
/***
 * @var $block_id string
 * @var $title string[]
 * @var $subtitle string[]
 * @var $model \app\modules\patient\models\RecordForm
 * @var $attribute string
 * @var $content string
 * @var $scenario string
 * @var $text string
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
    <h3 style="margin-bottom:0; margin-left:2px;"><?= $form->field($model, $attribute)->plusMinusCheckbox(['class' => 'collapser', 'data-collapse-target' => '.'.$block_id.'Profile', 'title' => $title]) ?></h3>
    <div class="panel-description">
      <div class="<?= $block_id ?>Profile state state-visible <?= $model->$attribute?"":"hidden" ?>"><?= $subtitle['checked'] ?></div>
      <div class="<?= $block_id ?>Profile state state-invisible <?= $model->$attribute?"hidden":"" ?>"><?= $subtitle['unchecked'] ?></div>
    </div>
    <div id="<?= $block_id ?>" class="<?= $block_id ?>Profile <?= $model->$attribute?"":"hidden" ?>">
	    <?php if ($text) { ?>
        <div class="col-sm-8" style="padding:10px 0 0 38px;">
            <p><?= $text ?></p>
        </div>
	    <?php } ?>
      <div id="<?= $block_id ?>Checkboxes" class="col-sm-12 profile-control-wrapper"><?= $content ?></div>
    </div>
  </div>

	<?php \app\components\ActiveForm::end(); ?>
</div>
