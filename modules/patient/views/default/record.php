<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\patient\models\RecordForm
   */

  use \app\components\Helper;
  use \app\modules\patient\models\RecordForm;

  $template = "<div class='form-group'>*{label}:\n{input}\n{hint}\n{error}</div>";
  $this->title = 'Medical Record';

  $this->registerCss(" .form-inline .form-group {margin-right:10px} ");
  \app\assets\RecordAsset::register($this);
?>

  <div class="col-sm-12 med-info__wrap">
    <h1 class="med-info__left-title">Medical Record</h1>
    <span class="med-info__right-text">Select Medical History items to display when your SaveLifeID card, bracelet or necklace is scanned.</span>
  </div>

<div class="col-sm-12">
  <?php
    $form = \app\components\ActiveForm::begin([
      'scenario' => RecordForm::SCENARIO_MAIN,
      'id' => 'medicalRecordForm',
      'options' => ['class' => 'medicalRecordForm'],
      'action' => '/subscriber-home/record',
      'enableClientValidation' => false,
      'enableAjaxValidation' => false,
      'fieldConfig' => [
        'template' => "\n<div class='form-group'>{label}:{input}</div>",
        'labelOptions' => ['class' => 'control-label'],
      ],
    ]);
  ?>
  <div class="col-sm-12 medical-record-form">
    <div class="row">
        <div class="col-xs-12">
          <?= $form->field($model, 'display_all', ['template' => '{input}<label for="recordform-display_all" class="pull-left"></label><label for="recordform-display_all" class="pull-right" style="display: inline; width: calc(100% - 35px);"><b>DISPLAY ALL</b> of my newly arriving medical information, automatically:  Check this box to make sure new medical information from your doctors is fully active and visible to emergency medical personnel. If you select below to be notified when your medical record is updated, that will allow you to review the information and change the visibility of any individual items you wish, as soon as it arrives in the system.</label><div class="clearfix"></div>'])->checkbox(['label' => null], false) ?>
        </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-sm-12">
        <p class="delete-breakrow">Click "Preview My Profile" to preview what your emergency profile will look like including your changes. <br>Changes on this page are remembered immediately and automatically reflected in the next profile display.</p>
        <p></p>
      </div>
      <div class="col-md-2 col-sm-12" style="padding-top: 8px;">
        <a href="<?= \Yii::$app->patient->model->getProfileUrl() ?>" target="_blank" class="btn btn-default right med-info__heading-btn">Preview My Profile</a>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 form-inline">
	      <?= $form->field($model, 'birthday')->widget('kartik\date\DatePicker',[
		      'type' => \kartik\date\DatePicker::TYPE_INPUT,
		      'options' => [
			      'placeholder'=>"MM/DD/YYYY"
		      ],
		      'pluginOptions' => [
			      'autoclose'=>true,
			      'format' => 'mm/dd/yyyy'
		      ]
	      ]) ?>

	      <?= $form->field($model, 'gender')->dropDownList([
		      null => '',
		      \app\modules\patient\models\Patient::GENDER_MALE => \app\modules\patient\models\Patient::GENDER_MALE,
		      \app\modules\patient\models\Patient::GENDER_FEMALE => \app\modules\patient\models\Patient::GENDER_FEMALE,
	      ])?>
        <div class="form-group med-info__height-group">
          <label for="sel1">Height:</label>
	        <?= \yii\bootstrap\Html::activeDropDownList($model, 'height_feet', [null =>'', 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8], ['class' => 'form-control']) ?>
          ft
	        <?= \yii\bootstrap\Html::activeDropDownList($model, 'height_inch', [null =>'', 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11], ['class' => 'form-control']) ?>
          inches
        </div>

	      <?= $form->field($model, 'weight', ['template' => "\n<div class='form-group med-info__weigth-group'>{label}<div class='med-info__weigth-group-input-wrap' style='display: inline-block; width:70px;'>{input}</div>lbs</div>"])->widget('kartik\widgets\TouchSpin', [
		      'pluginOptions' => [
			      'min' => 0,
			      'max' => 1000,
			      'verticalbuttons' => true,
			      'verticalupclass' => 'glyphicon glyphicon-plus',
			      'verticaldownclass' => 'glyphicon glyphicon-minus',
		      ]
	      ])->label('Weight:') ?>
      </div>
    </div>
</div>
  <?php \app\components\ActiveForm::end(); ?>
</div>

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
