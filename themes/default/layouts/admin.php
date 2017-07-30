<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */


$menu = [
	['href' => '/admin',                       'title' => 'Admin Home',              'prefix' => '<span class="glyphicon glyphicon-home"></span>'],
	['href' => '/admin/users/index',           'title' => 'Admin Users',             'prefix' => '<span class="glyphicon glyphicon-user"></span>'],
	['href' => '/admin/query-user/index',      'title' => 'Query User',              'prefix' => '<span class="glyphicon glyphicon-search"></span>'],
	['href' => '/admin/maintenance',           'title' => 'Maintenance Mode',        'prefix' => '<span class="glyphicon glyphicon-wrench"></span>'],
	['href' => '/admin/manage-practices/index','title' => 'Manage Practices',        'prefix' => '<span class="glyphicon glyphicon-list-alt"></span>'],
	['href' => '/admin/params',                'title' => 'Parameters',              'prefix' => '<span class="glyphicon glyphicon-cog"></span>'],
	['href' => '/admin/email',                 'title' => 'Test E-mail',             'prefix' => '<span class="glyphicon glyphicon-envelope"></span>'],
	['href' => '/admin/subscription-coupons',  'title' => 'Subscription Coupons',    'prefix' => '<span class="glyphicon glyphicon-scissors"></span>'],
];

$admin = (!Yii::$app->patient->isGuest && Yii::$app->patient->is_admin);

$menu = $admin?$menu:[
	['href' => '/',                  'title' => 'Home',              'prefix' => '<span class="glyphicon glyphicon-home"></span>'],
];

$menuHtml = Yii::$app->controller->getMenuHtml($menu, 'nav-stacked');

$this->params['menu'] = '';

?>

<?php $this->beginContent('@app/views/layouts/main.php') ?>
<div class="content">
  <div class="col-xs-12"><h1><?= $this->title ?></h1></div>
  <div class="admin-content-wrapper">
    <div class="col-xs-3"><?= $menuHtml ?></div>
    <div class="col-xs-9 tab-pane fade in active panel panel-default admin-content"><?= $content ?></div>
    <div class="clearfix"></div>
  </div>
</div>
<?php $this->endContent() ?>

