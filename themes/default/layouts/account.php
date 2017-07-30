<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */


$menu = [
	['href' => '/subscriber-home/account',          'title' => 'Personal information',        'prefix' => '<span class="glyphicon glyphicon-user"></span>'],
	['href' => '/subscriber-home/account-cancel',   'title' => 'Cancel lost or stolen card',  'prefix' => '<span class="glyphicon glyphicon-remove-sign"></span>'],
	['href' => '/subscriber-home/account-status',   'title' => 'Subscription status',         'prefix' => '<span class="glyphicon glyphicon-check"></span>', 'item-hrefs' => ['/subscriber-home/previous-payments', '/subscriber-home/account-status']],
	['href' => '/subscriber-home/account-security', 'title' => 'Security',                    'prefix' => '<span class="glyphicon glyphicon-lock"></span>'],
	['href' => '/subscriber-home/account-support',  'title' => 'Support',                     'prefix' => '<span class="glyphicon glyphicon-question-sign"></span>'],
];
$menuHtml = Yii::$app->controller->getMenuHtml($menu, 'nav-stacked');
?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>
<div class="content">
  <div class="col-xs-12"><h1><?= $this->title ?></h1></div>
  <div class="admin-content-wrapper">
    <div class="col-xs-4"><?= $menuHtml ?></div>
    <div class="col-xs-8 tab-pane fade in active panel panel-default"><?= $content ?></div>
    <div class="clearfix"></div>
  </div>
</div>
<?php $this->endContent() ?>

