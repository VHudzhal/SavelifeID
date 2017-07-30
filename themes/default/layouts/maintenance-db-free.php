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
        <div id="mainMenu">
          <?php if(isset($this->params['menu'])) {
            echo ($this->params['menu']);
          } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?= isset($this->params['slider'])?$this->params['slider']:'' ?>
<?php if (Yii::$app->request->hostInfo){ ?> <div id="mainContent" class="content"> <?php } ?>
<?= $content ?>
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