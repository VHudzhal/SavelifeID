<?php
  /**
   * @var $this \yii\web\View
   * @var $model \app\modules\patient\models\ChangePasswordForm
   */
?>

	<?php
	$form = \app\components\ActiveForm::begin([
		'id' => 'subscriber-home-security-change-password-form',
		'scenario' => 'change-password',
		'options' => [
			'class' => 'kvk-ajax-form',
			'data-target' => '.panel-change-password',
		],
		'enableClientValidation' => true,
		'enableAjaxValidation' => false,
		'fieldConfig' => [
			'template' => "\n<div class='form-group'>{label}:{input}{error}</div>",
			'labelOptions' => ['class' => 'control-label'],
		],
	]);
	?>

		<p>Your password must be at least 8 characters long. Ideally it will be longer. Do not choose common words or names. Including numbers or punctuation characters or even non-English characters can make your password stronger, but that is up to you.</p>
    <div class="row">
	    <?= \yii\helpers\Html::errorSummary($model, ['class' => 'alert alert-danger', 'header' => '']); ?>
      <?= $form->field($model, 'old_password', [
          'template' => "<div class='form-group'>{label}:<div class='input-group'>{input}<div class='input-group-btn'><button  type='submit' form='signInForm' class='btn btn-default' tabindex='999'>I forgot</buton></div></div></div>",
          'options' => ['class' => 'form-group col-md-4 margin-bottom-0']])->passwordInput(['autocomplete' => 'off']); ?>
      <?= $form->field($model, 'password', ['options' => ['class' => 'form-group col-md-4 margin-bottom-0']])->passwordInput(['autocomplete' => 'off']); ?>
      <?= $form->field($model, 'password_repeat', ['options' => ['class' => 'form-group col-md-4 margin-bottom-0']])->passwordInput(['autocomplete' => 'off']); ?>
    </div>

		<button type="submit" class="btn btn-default right" style="margin-top:25px">Change password</button>

	<?php \app\components\ActiveForm::end(); ?>
                
                <div style="display: none;">
        <?php 
            $forgotPasswordForm = \app\components\ActiveForm::begin([
                    'id' => 'signInForm',
                    'action' => '/login',
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => false,
                    'fieldConfig' => [
                            'template' => "\n<div class='form-group'>{label}:{input}</div>",
                            'labelOptions' => ['class' => 'control-label'],
                    ],
            ]); ?>
                <input type="text" id="loginform-email" class="form-control" name="LoginForm[email]" value="<?= Yii::$app->patient->email; ?>">
                <input type="text" id="loginform-forgot" class="form-control" name="LoginForm[forgot]" value='1' >

<script type="text/javascript">
  setTimeout(function(){
    var $el=jQuery("#subscriber-home-security-change-password-form .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
    jQuery('#subscriber-home-security-change-password-form').yiiActiveForm([{"id":"changepasswordform-old_password","name":"old_password","container":".field-changepasswordform-old_password","input":"#changepasswordform-old_password","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Current password cannot be blank."});}},{"id":"changepasswordform-password","name":"password","container":".field-changepasswordform-password","input":"#changepasswordform-password","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"New password cannot be blank."});yii.validation.string(value, messages, {"message":"New password must be a string.","min":8,"tooShort":"New password should contain at least 8 characters.","skipOnEmpty":1});yii.validation.regularExpression(value, messages, {"pattern":/^(?=.*[0-9])(.*)$/,"not":false,"message":"at least one digit required","skipOnEmpty":1});}},{"id":"changepasswordform-password_repeat","name":"password_repeat","container":".field-changepasswordform-password_repeat","input":"#changepasswordform-password_repeat","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Retype password cannot be blank."});yii.validation.compare(value, messages, {"operator":"==","type":"string","compareAttribute":"changepasswordform-password","skipOnEmpty":1,"message":"Passwords don't match"});}}], []);
  }, 1000);
</script>

        <?php \app\components\ActiveForm::end(); ?>
    </div>

<?php

  $this->registerJs("
$(document).on('blur keyup', '#changepasswordform-password, #changepasswordform-password_repeat', function(){
  $('#subscriber-home-security-change-password-form').yiiActiveForm('validateAttribute', $(this).attr('id'));
});
  
$(document).on('keyup', '#changepasswordform-password_repeat', function(){
  setTimeout(function(){
    var p1 = $('#changepasswordform-password').val();
    var p2 = $('#changepasswordform-password_repeat').val();
    // p1 = p1.substr(0, p2.length);
    
    if (p1 != p2) {
      $('#subscriber-home-security-change-password-form').yiiActiveForm('updateAttribute', 'changepasswordform-password_repeat', ['Passwords don\'t match']);
    } else {
      $('#subscriber-home-security-change-password-form').yiiActiveForm('updateAttribute', 'changepasswordform-password_repeat', []);
    }
  }, 100);
});  
  
");

?>
