<?php
  /** @var $model \app\modules\patient\models\Patient */
  /** @var $formModel \app\components\TimedForm */
  $this->title = 'New registration';
?>
<div class="container">
  <h1 style="margin-top:15px">New registration</h1>

  <p>Registration is currently only available through participating physicians. Please enter the SLID# printed on the SaveLifeID card issued to you in the Doctor's office.</p>
	<?php $form = \app\components\TimedClientForm::begin([
		'id' => 'registration-form',
		'action' => '/register',
		'enableClientValidation' => true,
		'enableAjaxValidation' => false,
		'fieldConfig' => [
			'template' => "\n<div class='form-group'>{label}:{input}</div>",
			'labelOptions' => ['class' => 'control-label'],
		],
	]); ?>
	  <?php $form->registerTries($formModel); ?>
    <div class="container-fluid">
      <div class="row">
	      <?php if ($formModel->hasErrors()){ ?>
		      <?= \yii\helpers\Html::errorSummary($formModel, ['class' => 'alert alert-danger', 'header' => '']); ?>
	      <?php } ?>
        <div class="xs-12">
          <label>
            SLID#:
            <input type="text" name="slid" value="<?= $model->internal_id ?>">
            <button type="submit" class="btn btn-success">Register</button>
            <a href="/img/slid-card.jpg" data-fancybox>Help</a>
          </label>
	        <?= $form->field($formModel, 'slid', ['template' => '{input}'])->textInput(['class' => 'hidden']); ?>
        </div>
      </div>
    </div>
  <?php \app\components\TimedClientForm::end(); ?>
  <p>If you do not have a card, please check back again soon when it will be possible to register without one.</p>
</div>
<?php /*
<ul class="pagination right">
	<?= $this->params['submenu'] ?>
</ul>

<div class="error"></div>

<div class="alert alert-success" style="clear:both">
  <strong>STEP 1:</strong> Manage your mobile phone number (optional) and security questions.
</div>
<div class="alert alert-info">
  Please enter the registration information requested below. <strong>All security question fields are required.</strong>
</div>

<div class="error"></div>

<style>
  .form-inline {margin-bottom:15px}
  .form-inline select.form-control {margin-left:4px;width:380px}
  .form-inline input.form-control {width:180px}
</style>

<form action="/register/billing/" class="enrollment" id="enrollment_form" name="account_updates" method="post">

  <input type="hidden" name="RET" value="/register">
  <input type="hidden" name="form_type" value="modify_account_settings">
  <input type="hidden" name="username" id="username" value="">

  <div class="col-sm-9">

    <div class="form-inline">
      <div class="form-group">
        <label for="m_field_id_3">Security Question 1:</label>
        <select class="form-control" name="m_field_id_3" id="m_field_id_3">
          <option value=""></option>
          <option value="What is your mother's name?">What is your mother's name?</option>
          <option value="What is your father's birth place?">What is your father's birth place?</option>
          <option value="What was the first and last name of your childhood best friend? ">What was the first and last name of your childhood best friend?</option>
          <option value="What is your favorite book?">What is your favorite book?</option>
          <option value="What is the first and last name of your first boyfriend or girlfriend?">What is the first and last name of your first boyfriend or girlfriend?</option>
          <option value="Which phone number do you remember most from your childhood?">Which phone number do you remember most from your childhood?</option>
          <option value="What was your favorite place to visit as a child?">What was your favorite place to visit as a child?</option>
        </select>
      </div>
      <div class="form-group">
        <label for="m_field_id_4">&nbsp;</label>
        <input type="text" name="m_field_id_4" class="form-control" id="m_field_id_4" placeholder="Answer security question here">
      </div>
    </div>
    <div class="form-inline">
      <div class="form-group">
        <label for="m_field_id_5">Security Question 2:</label>
        <select class="form-control" name="m_field_id_5" id="m_field_id_5">
          <option value=""></option>
          <option value="Who is your favorite actor?">Who is your favorite actor?</option>
          <option value="Who is your favorite musician?">Who is your favorite musician?</option>
          <option value="Who is your favorite writer?">Who is your favorite writer?</option>
          <option value="Who is your favorite painter?">Who is your favorite painter?</option>
          <option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
          <option value="In what city were you born?">In what city were you born?</option>
          <option value="What high school did you attend?">What high school did you attend?</option>
        </select>
      </div>
      <div class="form-group">
        <label for="m_field_id_6">&nbsp;</label>
        <input type="text" name="m_field_id_6" class="form-control" id="m_field_id_6" placeholder="Answer security question here">
      </div>
    </div>
    <div class="form-inline">
      <div class="form-group">
        <label for="m_field_id_7">Security Question 3:</label>
        <select class="form-control" name="m_field_id_7" id="m_field_id_7">
          <option value=""></option>
          <option value="What is the name of your first school?">What is the name of your first school?</option>
          <option value="What is your favorite movie?">What is your favorite movie?</option>
          <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
          <option value="What street did you grow up on?">What street did you grow up on?</option>
          <option value="What was the make of your first car?">What was the make of your first car?</option>
        </select>
      </div>
      <div class="form-group">
        <label for="m_field_id_8">&nbsp;</label>
        <input type="text" name="m_field_id_8" class="form-control" id="m_field_id_8" placeholder="Answer security question here">
      </div>
    </div>
    <div class="form-inline">
      <div class="form-group">
        <label for="m_field_id_9">Security Question 4:</label>
        <select class="form-control" name="m_field_id_9" id="m_field_id_9">
          <option value=""></option>
          <option value="When is your anniversary?">When is your anniversary?</option>
          <option value="What is your favorite color?">What is your favorite color?</option>
          <option value="What is your father's middle name?">What is your father's middle name?</option>
          <option value="What is the name of your first grade teacher?">What is the name of your first grade teacher?</option>
          <option value="What was your high school mascot?">What was your high school mascot?</option>
          <option value="What is your mother's middle name?">What is your mother's middle name?</option>
        </select>
      </div>
      <div class="form-group">
        <label for="m_field_id_10">&nbsp;</label>
        <input type="text" name="m_field_id_10" class="form-control" id="m_field_id_8" placeholder="Answer security question here">
      </div>
    </div>

  </div>

  <div class="form-group col-sm-3 right" style="padding-right:0">
    <label for="cell_phone">Mobile Phone (optional):</label>
    <input type="text" class="form-control" id="cell_phone">
    <div class="checkbox">
      <label><input type="checkbox">  I agree to the <a href="/terms-of-use" target="_blank">terms of use</a></label>
    </div>
  </div>



  <button type="submit" class="btn btn-success right">Register</button>

</form>
 */