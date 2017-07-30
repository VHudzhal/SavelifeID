<?php
  /**
   * @var $model \app\modules\patient\models\EmergencyContacts
   * @var $this \yii\web\View
   */
?>

<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
  <div class="col-sm-10 padding-0">
    <div class="col-xs-12 padding-0 contact-info-item-name"><?= $model->contact_name ?></div>
    <div class="col-sm-12 nop d-ib notify-checkboxes">
      <div class="col-xs-12 absolute-checkbox__wrap">
		  <?php if ($model->contact_cell){ ?>
        <?= \app\components\Helper::checkBox('RecordForm[emergency_contacts_notify_cell][]', $model->contact_id, [
          'checked' => $model->notify_cell,
          'label' => ' Notify on each scan by text to: '.$model->contact_cell,
        ]); ?>
		  <?php } ?>
      </div>
      <div class="col-xs-12 absolute-checkbox__wrap">
		  <?php if ($model->contact_email){ ?>
        <?= \app\components\Helper::checkBox('RecordForm[emergency_contacts_notify_email][]', $model->contact_id, [
          'checked' => $model->notify_email,
          'label' => ' Notify on each scan by email to: '.$model->contact_email,
        ]); ?>
		  <?php } ?>
      </div>
    </div>

  </div>
  <div class="col-sm-2 nop cr">
	  <?= \app\components\Helper::eyeInput('RecordForm[emergency_contacts_notify_display][]', $model->contact_id, [
		  'checked' => $model->display,
		  'label' => false,
		  'clearfix' => false,
      'wrapper_class' => 'checkbox-type-eye-wrapper pull-right stateful-title',
      'eye_class' => 'pt-6'
	  ]); ?>
	  <?php if ($model->added_by_user == 1){ ?>
        <a class="glyphicon glyphicon-remove chk-6 js-remove-emergency-contact-item pull-right" href='#' data-id="<?= $model->contact_id ?>" title="Click to remove this contact from your record" data-toggle="tooltip" data-placement="left"></a>
	  <?php } ?>
  </div>
  <div class="clearfix"></div>
</li>

