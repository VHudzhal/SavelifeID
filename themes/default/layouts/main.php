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
<body class="ca-<?= Yii::$app->controller->id ?>-<?= Yii::$app->controller->action->id ?> patient-<?= Yii::$app->patient->isGuest?'guest':'registred' ?>">
<?php $this->beginBody() ?>

<div id="header">
  <div class="clearfix">
    <div class="col-sm-4 col-xs-12">
      <a href="<?= Yii::$app->patient->homeUrl ?>"><img class="header-logo__img" src="/img/savelife logo.jpg" height="100"></a>
    </div>
    <div class="col-sm-8 col-xs-12 cr">
      <div id="signin-area">
        <?php if (!Yii::$app->patient->isGuest){
            $status_name = Yii::$app->patient->isActivated?ucfirst(Yii::$app->patient->status):'';
            $link_name   = (Yii::$app->patient->status == Patient::STATUS_ACTIVE) ? "Pause account" : "Resume account" ;
            if (Yii::$app->patient->isActivated) {
	            $status      = (Yii::$app->patient->status == Patient::STATUS_ACTIVE) ? "<span class='green'>{$status_name}" : "<span class='red'>{$status_name}";
	            $status     .= " (<a class='js-subscription-status' href='/subscriber-home/account#subscription-status'>{$link_name}</a>)</span>";
	            $status      = "Signed in: ".Yii::$app->patient->model->getFullName(). /*" - {$status}*/" - <a href='/logout'>sign out</a>";
            } else {
	            $status      = "Signed in: ".Yii::$app->patient->model->getFullName();
            }
          ?>
          <?= $status ?>
       <?php } ?>
        <div id="mainMenu">
          <?php if (!Yii::$app->patient->isGuest){ ?>
            <!-- Session Progress Indicator -->
            <div class="session-countdowner" style="margin-top:0;height:30px">
              <div class="col-sm-7 col-xs-12 lpd">
                <div class="progress" style="height:7px;margin:7px 0 0 0">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
                </div>
              </div>
              <div class="col-sm-5 col-xs-12 nop">Auto logout <time class="relative">in <?= round(\app\modules\patient\components\Patient::AUTH_TIMEOUT / 60) ?> minutes</time></div>
            </div>
          <?php } ?>

        <!-- Page links -->
          <?php if(isset($this->params['menu'])) {
            echo ($this->params['menu']);
          } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /*
<div id="header">
  <a href="<?= Yii::$app->patient->homeUrl ?>"><img src="/img/savelife logo.jpg" height="100"></a>
  <div id="signin-area"></div>
  <div class="clearfix"></div>
  <div id="mainMenu">
    <div class="row">
      <div class="col-sm-12 text-right" style="margin-top:0;height:30px">
        <div class="col-sm-12 nop">
          <?php if (!Yii::$app->patient->isGuest){
            $status = (Yii::$app->patient->status == 'active')?"<span class='green'>ACTIVE</span>":"<span class='red'>NOT ACTIVE (<a href='#'>activate</a>)</span>"; ?>
              Signed in: <?= Yii::$app->patient->first_name ?> <?= Yii::$app->patient->last_name ?> - <?= $status ?>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12" style="margin-top:0;height:30px">
        <div class="col-sm-7 lpd">
          <div class="progress" style="height:7px;margin:7px 0 0 0">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
            </div>
          </div>
        </div>
        <div class="col-sm-5 nop">Auto logout in 12 min <a href="/logout" style="margin-left:10px">Sign out</a></div>
      </div>
    </div>
    <!-- Page links -->
    <ul class="pagination" style="margin:0 10px 0 0">
      <?php if(isset($this->params['menu'])) {
        echo ($this->params['menu']);
      } else {
	      $menu = array(
	        '/' => 'Home',
	        '/about-us' =>'About Us',
	        '/faq'=>'FAQ'
        );

	      foreach ($menu as $link => $name) {
	        $active = ('/'.Yii::$app->request->pathInfo == $link)?' class="active"':'';
		      echo '<li'.$active.'><a href="'.$link.'">'.$name.'</a></li>';
	      }
      } ?>
    </ul>
    <?php
      if (Yii::$app->patient->isGuest){
	      echo $this->render('signUp');
      } else {
	      // echo $this->render('signOut');
      }
    ?>
  </div>

</div>
*/ ?>
<?= isset($this->params['slider'])?$this->params['slider']:'' ?>
<?php if (Yii::$app->request->hostInfo){ ?> <div id="mainContent" class="content"> <?php } ?>
<?= $content ?>
<?php if (Yii::$app->request->hostInfo){ ?> </div> <?php } ?>
<?php
  if (isset($this->params['modal'])){
	  echo $this->params['modal'];
  } else { ?>
    <!-- Modal -->
    <div class="modal fade" id="signIN" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button onClick="setTimeout(signINclear,500)" type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="signinTitle">Sign In</h4>
          </div>
          <?php if (Yii::$app->patient->isGuest) { ?>
            <div class="modal-body">
              <?php $loginForm = new \app\models\LoginForm(); ?>
              <?php $form = \app\components\ActiveForm::begin([
                'id' => 'signInForm',
                'action' => '/login',
                'enableClientValidation' => false,
                'enableAjaxValidation' => false,
                'fieldConfig' => [
                  'template' => "\n<div class='form-group'>{label}:{input}</div>",
                  'labelOptions' => ['class' => 'control-label'],
                ],
              ]); ?>
                <?= $form->field($loginForm, 'email') ?>
                <?= $form->field($loginForm, 'password', ['template' => "<div class='form-group'>{label}:<div class='input-group'>{input}<div class='input-group-btn'><button  type='button' class='btn btn-default btn-forgot' tabindex='999'>I forgot</button></div></div></div>"])->passwordInput() ?>
                <button type="submit" class="hidden"></button>
                <!--<div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
              </div>-->
              <?php \app\components\ActiveForm::end(); ?>
              <!-- Forgot password -->
              <div class="forgotPassMessage">If this email address is associated with an account, instructions for resetting your password have just been emailed to you.</div>
            </div>
          <?php } ?>
          <div class="modal-footer">
            <button onClick="setTimeout(signINclear,500)" id="closeButton" class="btn btn-default" data-dismiss="modal">Close</button>
            <button onClick="signIN();" id="signinButton" type="submit" class="btn btn-success">Sign In</button>
          </div>
        </div>
      </div>
    </div>
 <?php } ?>

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
<div id="messager-system-wrapper"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>