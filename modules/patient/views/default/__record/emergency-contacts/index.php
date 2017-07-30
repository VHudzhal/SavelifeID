<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\patient\models\RecordForm
 */
use app\modules\patient\models\RecordForm;
?>
<div class="panel panel-default panel-emergency-contacts" style="margin-top:20px;">
	<div class="panel-body">
		<?php
		$form = \app\components\ActiveForm::begin([
			'scenario' => RecordForm::SCENARIO_EMERGENCY_CONTACTS_VISIBILITY,
			'id'     => 'medicalRecordForm-emergency-contacts-visibility',
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
		<h3 style="margin-bottom:0; margin-left:2px;"><?= $form->field($model, 'display_emergency_contacts')->plusMinusCheckbox(['class' => 'collapser', 'data-active-form' => '#medicalRecordForm-emergency-contacts', 'data-collapse-target' => '.emergencyContactsProfile', 'title' => ['checked' => 'Click to prevent any Emergency Contacts from appearing on your emergency profile; otherwise, selected Emergency Contacts will appear.', 'unchecked' => 'Click to allow selected Emergency Contacts to appear on your emergency profile; otherwise none will appear.']]) ?></h3>
		<div class="panel-description">
			<div class="emergencyContactsProfile state state-visible <?= $model->display_emergency_contacts?"":"hidden" ?>">Emergency Contacts can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball</div>
			<div class="emergencyContactsProfile state state-invisible <?= $model->display_emergency_contacts?"hidden":"" ?>">Emergency Contacts information will not be displayed in your emergency profile until you click the section's eyeball to enable it.</div>
		</div>
		<?php \app\components\ActiveForm::end() ?>
		<div id="emergency-contact-info" class="emergencyContactsProfile <?= $model->display_emergency_contacts?'':'hidden' ?>">
			<div id="emergencyContactCheckboxes" class="col-sm-12 profile-control-wrapper">
        <div class="row">
          <div class="col-sm-8">
            <?php
            $form = \app\components\ActiveForm::begin([
              'scenario' => RecordForm::SCENARIO_EMERGENCY_CONTACTS,
              'id'     => 'medicalRecordForm-emergency-contacts',
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
              <ul class="list-group">
                <?php foreach ($model->emergencyContacts as $contact){ ?>
                  <?= $this->render('____emergency-contact-item', ['model' => $contact]); ?>
                <?php } ?>
              </ul>
              <?php $hiddenClass = $model->emergencyContacts?"hidden":"";?>
              <div class="js-null-mesage alert alert-info <?= $hiddenClass ?>">SaveLifeID can notify your Contacts in an emergency (whenever your card is scanned). But you must add a contact including a cell phone number or email address for notification by SMS or email. Then simply click the check-boxes of the notifications you want each contact to receive.</div>
            <?php \app\components\ActiveForm::end() ?>
          </div>
          <div class="col-sm-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <?= $this->render('___emergency_contact_form') ?>
              </div>
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>
</div>
