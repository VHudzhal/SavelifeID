<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use \app\modules\patient\models\Patient;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <title><?= Html::encode($this->title) ?></title>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<?= Html::csrfMetaTags() ?>
	<?php $this->head() ?>
</head>
<body class="ca-<?= Yii::$app->controller->id ?>-<?= Yii::$app->controller->action->id ?>">
<?php $this->beginBody() ?>
<div id="header">
  <div class="clearfix">
    <div class="col-md-4 col-xs-12">
      <a href="/"><img class="header-logo__img" src="/img/savelife logo.jpg" height="100"></a>
    </div>
    <div class="col-md-8 col-xs-12 cr">
      <div id="signin-area">
        <?php if (!Yii::$app->patient->isGuest){
            $status_name = Yii::$app->patient->isActivated?ucfirst(Yii::$app->patient->status):'';
            $link_name   = (Yii::$app->patient->status == Patient::STATUS_ACTIVE) ? "Pause account" : "Resume account" ;
            if (Yii::$app->patient->isActivated) {
	            $status      = (Yii::$app->patient->status == Patient::STATUS_ACTIVE) ? "<span class='green'>{$status_name}" : "<span class='red'>{$status_name}";
	            $status     .= " (<a class='js-subscription-status' href='/subscriber-home/account#subscription-status'>{$link_name}</a>)</span>";
	            $status      = "Signed in: ".Yii::$app->patient->model->getFullName(). " - <a href='/logout'>sign out</a>";
            } else {
	            $status      = "Signed in: ".Yii::$app->patient->model->getFullName();
            }
          ?>
          <?= $status ?>
       <?php } ?>
      </div>
    </div>
  </div>
</div>

<?= isset($this->params['slider'])?$this->params['slider']:'' ?>
<?php if (Yii::$app->request->hostInfo){ ?> <div id="mainContent" class="content"> <?php } ?>
<?= $content ?>

  <?php if (Yii::$app->patient->isGuest){ ?>
    <?php /* if (Yii::$app->controller->action->id !== 'login'){ ?>
      <?php $loginForm = new \app\models\LoginForm(); ?>
      <?php $form = \app\components\TimedClientForm::begin([
        'id' => 'signInForm',
        'action' => '/login',
        'enableClientValidation' => false,
        'enableAjaxValidation' => false,
        'fieldConfig' => [
          'template' => "\n<div class='form-group'>{label}:{input}</div>",
          'labelOptions' => ['class' => 'control-label'],
        ],
      ]); ?>
		  <?php $form->registerTries($loginForm); ?>
      <?= $form->field($loginForm, 'email')->textInput(['autofocus' => true]) ?>

      <?= $form->field($loginForm, 'password', ['template' => "<div class='form-group'>{label}:<div class='input-group'>{input}<div class='input-group-btn'><button  type='button' class='btn btn-default btn-forgot' tabindex='999'>I forgot</buton></div></div></div>"])->passwordInput() ?>

      <div class="form-group">
        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary col-xs-12', 'name' => 'login-button']) ?>
      </div>
      <?php \app\components\TimedClientForm::end(); ?>
    <?php } ?>
  <?php */ }  else { ?>
      <?php if (Yii::$app->patient->is_admin) { ?>
          <div class="text-center">
            <a class="btn btn-danger" href="/?maintenance=off">Turn off maintenance mode</a>
          </div>
      <?php } ?>
  <?php } ?>

  <?php if (Yii::$app->request->hostInfo){ ?> </div> <?php } ?>

<div class="clearfix"></div>
<div id="footer">
  <div id="footerContent">
    <p><img src="/img/savelifeid-logo-footer.png"></p>
    <p>Contact: <a href="mailto:info@savelifeid.com">info@savelifeid.com</a></p>
    <p><b>Copyright 2017 CommLife Solutions, Inc. <br class="footer-br">
        10 E 39th St, 10th Floor
        New York, NY 10016<br class="footer-br">
        All Rights Reserved</b><br class="footer-br"> <span class="hidden-tablet"> |&nbsp;</span>
      <a href="/terms-of-use">Terms of Use</a> &nbsp;|&nbsp;
      <a href="/privacy-policy">Privacy Policy</a> &nbsp;|&nbsp;
      <a href="/faq">FAQ</a></p>
  </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>