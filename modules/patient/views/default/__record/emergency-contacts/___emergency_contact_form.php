<?php

 /**
  * @var $this \yii\web\View
  */

?>


<?php
$form = \app\components\ActiveForm::begin([
	'id' => 'addEmergencyContactForm',
	'type' => \app\components\ActiveForm::TYPE_VERTICAL,
	'action' => '/subscriber-home/add-emergency-contact',
	'options' => ['class' => 'addEmergencyContactForm'],
	'enableClientValidation' => true,
	'validateOnType' => true,
	'validateOnBlur' => true,
  'validationDelay' => 1,
	'enableAjaxValidation' => false,
]);

$model = new \app\modules\patient\models\EmergencyContacts();
?>

<h4 style="margin-top:0">Add New Contact Here:</h4>
	<?= $form->field($model, 'contact_name', ['options' => ['class' => 'form-group block-wrapper']])->textInput() ?>

  <div class="block-wrapper">
	  <?= $form->field($model, 'contact_cell', ['options' => ['class' => 'form-group', 'style' => "padding-left:0"]])->textInput() ?>

    <div class="chktext">
      <?= \yii\bootstrap\Html::hiddenInput('EmergencyContacts[notify_cell]', 0)?>
      <?= \yii\bootstrap\Html::checkbox('EmergencyContacts[notify_cell]', false, ['value' => 1, 'id'=> 'emergency-contacts--notify-cell', 'disabled' => 'disabled'])?>
      <?= \yii\bootstrap\Html::label('Notify by text on scan', 'emergency-contacts--notify-cell', ['class' => 'visible'])?>
    </div>
  </div>

  <div class="block-wrapper">
	  <?= $form->field($model, 'contact_email', ['options' => ['class' => 'form-group', 'style' => "padding-left:0"]])->textInput() ?>

    <div class="chktext">
      <?= \yii\bootstrap\Html::hiddenInput('EmergencyContacts[notify_email]', 0)?>
      <?= \yii\bootstrap\Html::checkbox('EmergencyContacts[notify_email]', false, ['value' => 1, 'id'=> 'emergency-contacts--notify-email', 'disabled' => 'disabled'])?>
      <?= \yii\bootstrap\Html::label('Notify by e-mail on scan', 'emergency-contacts--notify-email', ['class' => 'visible'])?>
    </div>
  </div>

	<div class="col-sm-12 nop"><button type="submit" class="btn btn-success right">Add contact</button></div>

<?php \app\components\ActiveForm::end() ?>

<?php

$this->registerJs("
  $('#addEmergencyContactForm').on('afterValidateAttribute', function (event, attribute, messages){
    var disabled = messages.length?true:false;
    
    var checkbox = $(attribute.input).parents('.block-wrapper').find(\"input[type='checkbox']\");
    disabled = disabled || ($(attribute.input).val().length == 0) ;
    
    checkbox.prop('disabled', disabled);
    if (disabled) {
      checkbox.prop('checked', false);
    }
  });
  
  $('#addEmergencyContactForm').on('after-submit', function(){
    $('.stateful-title').each(function(){
      new __stateful_title(this);
    });
    $('[data-toggle=\"tooltip\"]').tooltip();
  });
  
");

?>



