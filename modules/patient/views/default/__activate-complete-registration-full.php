<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\patient\models\RecordForm
   */
use \app\components\Helper;
use \app\modules\patient\models\RecordForm;
?>
<?= $this->render( '____activate-complete-registration-inner',     [ 'model' => $model]); ?>

<div class="col-sm-12" id="blocks">
	<?= $this->render('__record/profile-summary/index',     ['model' => $model]); ?>
	<?= $this->render('__record/medical-conditions/index',  ['model' => $model]); ?>
	<?= $this->render('__record/medical-history/index',     ['model' => $model]); ?>
	<?= $this->render('__record/surgical-items/index',      ['model' => $model]); ?>
	<?= $this->render('__record/allergical-items/index',    ['model' => $model]); ?>
	<?= $this->render('__record/medications-items/index',   ['model' => $model]); ?>
	<?= $this->render('__record/vaccinations-items/index',  ['model' => $model]); ?>
	<?= $this->render('__record/hospitals-items/index',     ['model' => $model]); ?>
	<?= $this->render('__record/insurance-items/index',     ['model' => $model]); ?>
	<?= $this->render('__record/other-physicians/index',    ['model' => $model]); ?>
	<?= $this->render('__record/device-dependencies/index', ['model' => $model]); ?>
	<?= $this->render('__record/comments/index',            ['model' => $model]); ?>
	<?= $this->render('__record/emr-summary/index',         ['model' => $model]); ?>

	<?= $this->render('__record/files/index',               ['model' => $model, 'type' => \app\modules\patient\models\PatientFiles::TYPE_ADVANCED_DIRECTIVE]) ?>
	<?= $this->render('__record/files/index',               ['model' => $model, 'type' => \app\modules\patient\models\PatientFiles::TYPE_EKG]) ?>
	<?= $this->render('__record/files/index',               ['model' => $model, 'type' => \app\modules\patient\models\PatientFiles::TYPE_OTHER]) ?>

	<?= $this->render('__record/emergency-contacts/index',  ['model' => $model]); ?>
	<?= $this->render('__record/notifications/index',       ['model' => $model]); ?>

</div>

<div class="hidden record-form-templates">
  <ul class="custom-emergency-profile">
    <li class="list-group-item">
      <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper">
  	      <?= \yii\bootstrap\Html::hiddenInput('RecordForm[emergency_profile_items_ids][]', 0)?>
        <a href="#" class="glyphicon glyphicon-remove chk-6 top0 js-remove-profile-item" data-id=""  data-toggle="tooltip" data-placement="left" title="Click here to remove this custom-defined text from your emergency profile and from this list"></a>
      </span>
      <span class="item-name"></span>
      <div class="clearfix"></div>
    </li>
  </ul>

</div>
