<?php
use \yii\helpers\BaseVarDumper;

/* @var $this yii\web\View */

?>
<h2>Parameters</h2>
<div class="panel panel-default">
		<table class="table table-hover table-bordered table-striped lcss-params-table">
      <tr><th colspan="2" class="text-center">Environment</th></tr>
			<tr><td>Instance ID</td><td><?= $instance_id ?></td></tr>
			<tr><td>Environment type</td><td><?= $env ?></td></tr>

      <tr><th colspan="2" class="text-center">Database</th></tr>
      <tr><td>DB host</td><td><?= BaseVarDumper::dump(getenv('DB_HOST')) ?></td></tr>
      <tr><td>DB name</td><td><?= BaseVarDumper::dump(getenv('DB_NAME')) ?></td></tr>
      <tr><td>DB user</td><td><a href="#" class="js-show-hidden btn btn-default">Display</a><span class="hidden"><?= BaseVarDumper::dump(getenv('DB_USER')) ?></span></td></tr>
      <tr><td>DB password</td><td><span class="text-danger">Hidden</span></td></tr>
      <tr><td>DB SSL CA</td><td><?= BaseVarDumper::dump(getenv('DB_SSL_CA')) ?></td></tr>
      <tr><td>DB SSL cert</td><td><?= BaseVarDumper::dump(getenv('DB_SSL_CERT')) ?></td></tr>
      <tr><td>DB SSL key</td><td><?= BaseVarDumper::dump(getenv('DB_SSL_KEY')) ?></td></tr>

      <tr><th colspan="2" class="text-center">Amazon S3</th></tr>
      <tr><td>Bucket image</td><td><?= BaseVarDumper::dump(getenv('BUCKET_IMAGE')) ?></td></tr>
      <tr><td>Bucket region</td><td><?= BaseVarDumper::dump(getenv('BUCKET_IMAGE_REGION')) ?></td></tr>
      <tr><td>Bucket root</td><td><?= BaseVarDumper::dump(getenv('BUCKET_IMAGE_ROOT')) ?></td></tr>
      <tr><td>Bucket access key</td><td>
          <?php /* <a href="#" class="js-show-hidden btn btn-default">Display</a><span class="hidden"><?= BaseVarDumper::dump(getenv('BUCKET_ACCESS_KEY')) ?></span> */ ?>
          <span class="text-danger">Hidden</span>
        </td></tr>
      <tr><td>Bucket secret Key</td><td>
          <?php /* <a href="#" class="js-show-hidden btn btn-default">Display</a><span class="hidden"><?= BaseVarDumper::dump(getenv('BUCKET_SECRET_KEY')) ?></span> */ ?>
          <span class="text-danger">Hidden</span>
        </td></tr>

      <tr><th colspan="2" class="text-center">email</th></tr>
      <tr><td>Admin email</td><td><?= BaseVarDumper::dump(getenv('ADMIN_EMAIL')) ?></td></tr>
      <tr><td>Robot email</td><td><?= BaseVarDumper::dump(getenv('ROBOT_EMAIL')) ?></td></tr>
      <tr><td>SMTP host</td><td><?= BaseVarDumper::dump(getenv('SMTP_HOST')) ?></td></tr>
      <tr><td>SMTP port</td><td><?= BaseVarDumper::dump(getenv('SMTP_PORT')) ?></td></tr>
      <tr><td>SMTP user</td><td><a href="#" class="js-show-hidden btn btn-default">Display</a><span class="hidden"><?= BaseVarDumper::dump(getenv('SMTP_USER')) ?></span></td></tr>
      <tr><td>SMTP password</td><td><span class="text-danger">Hidden</span></td></tr>

      <tr><th colspan="2" class="text-center">Etc</th></tr>
      <tr><td>Server role</td><td><?= BaseVarDumper::dump(getenv('SERVER_ROLE')) ?></td></tr>
      <tr><td>Cookie domain</td><td><?= BaseVarDumper::dump(getenv('COOKIE_DOMAIN')) ?></td></tr>
      <tr><td>Profile host</td><td><?= BaseVarDumper::dump(getenv('PROFILE_HOST')) ?></td></tr>
      <tr><td>Router host</td><td><?= BaseVarDumper::dump(getenv('ROUTER_HOST')) ?></td></tr>
      <tr><td>Www host</td><td><?= BaseVarDumper::dump(getenv('WWW_HOST')) ?></td></tr>
      <tr><th colspan="2" class="text-center">Stripe</th></tr>
      <tr><td>Stripe Key Param</td><td><?= BaseVarDumper::dump(getenv('STRIPE_KEY_NAME')) ?></td></tr>
      <tr><td>Stripe Key</td><td>
          <?php /* <a href="#" class="js-show-hidden btn btn-default">Display</a><span class="hidden"><?= Yii::$app->awsParams->getParam(getenv("STRIPE_KEY_NAME"), '<span class="text-danger">not set</span>') ?></span> */ ?>
          <span class="text-danger">Hidden</span>
        </td></tr>
		</table>
	</div>
</div>

<?php

  $this->registerCss("
.lcss-params-table tr td:last-child { text-align: right; }
");

  $this->registerJs("
$('.js-show-hidden').on('click', function(e){
  e.preventDefault();
  $(this).hide().siblings('.hidden').removeClass('hidden');
});  
");